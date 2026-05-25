# Rotas de Treino — FreelanceHub

---

## Rota 1 — Listagem de freelancers disponíveis
**`GET /api/freelancers/disponiveis`**

```json
[
  {
    "id": 1,
    "nome_completo": "Ana Lima",
    "localizacao": "São Paulo / SP",
    "valor_hora": "R$ 120,00",
    "nota": 4.8,
    "avaliacoes": 12,
    "habilidades": ["Vue.js", "Laravel"],
    "disponibilidade": "Disponível"
  }
]
```

**Regras:**
- Somente freelancers com `availability_status = 'available'`
- `nome_completo` → `users.name`
- `localizacao` → `freelancers.city` + `" / "` + `freelancers.state`
- `valor_hora` → `hourly_rate` formatado em reais
- `habilidades` → `skills.name` via pivot `freelancer_skill`
- `disponibilidade` → enum `availability_status` traduzido

**Status:** ✅ Concluída

---

## Rota 2 — Detalhes de um projeto
**`GET /api/projetos/{id}`**

```json
{
  "identificador": 5,
  "titulo": "Sistema de agendamento online",
  "empresa": "TechCorp Soluções",
  "email_empresa": "contato@techcorp.com",
  "categoria": "Desenvolvimento Web",
  "orcamento": {
    "minimo": 5000.00,
    "maximo": 8000.00,
    "faixa": "R$ 5.000 - R$ 8.000"
  },
  "prazo_limite": "30/08/2026",
  "total_propostas": 7,
  "menor_proposta": 4800.00,
  "maior_proposta": 9200.00,
  "habilidades_requeridas": ["Laravel", "Vue.js", "MySQL"],
  "situacao": "Aberto para propostas"
}
```

**Regras:**
- `empresa` → `companies.company_name`
- `email_empresa` → `users.email` via `company → user`
- `categoria` → `categories.name`
- `orcamento.faixa` → campo calculado/formatado
- `prazo_limite` → `projects.deadline` no formato `d/m/Y`
- `total_propostas` → `COUNT(bids)`
- `menor_proposta` → `MIN(bids.proposed_value)`
- `maior_proposta` → `MAX(bids.proposed_value)`
- `habilidades_requeridas` → `skills.name` via pivot `project_skill`
- `situacao` → enum `projects.status` traduzido
- Retorna 404 se o projeto não existir

---

## Rota 3 — Dashboard financeiro de uma empresa
**`GET /api/empresas/{id}/painel`**

```json
{
  "razao_social": "TechCorp Soluções",
  "cnpj": "12.345.678/0001-90",
  "email": "contato@techcorp.com",
  "resumo_projetos": {
    "ativos": 3,
    "concluidos": 5,
    "abertos": 2
  },
  "financeiro": {
    "investimento_total": 45000.00,
    "em_aberto": 12000.00
  },
  "freelancers_contratados": 4,
  "nota_media_como_contratante": 4.6
}
```

**Regras:**
- `razao_social` → `companies.company_name`
- `email` → `users.email` via `company → user`
- `resumo_projetos.*` → `COUNT(projects)` agrupado por `status`
- `financeiro.investimento_total` → `SUM(payments.amount)` onde `status = 'completed'`, via `contracts`
- `financeiro.em_aberto` → `SUM(milestones.value)` onde `status != 'paid'`, via `contracts`
- `freelancers_contratados` → `COUNT DISTINCT(contracts.freelancer_id)`
- `nota_media_como_contratante` → `AVG(reviews.rating)` onde `reviewer_type = 'company'`, via `contracts`
- Retorna 404 se a empresa não existir

---

## Rota 4 — Resumo financeiro de um contrato
**`GET /api/contratos/{id}/financeiro`**

```json
{
  "numero_contrato": 1,
  "projeto": "Sistema de agendamento online",
  "freelancer": "Ana Lima",
  "contratante": "TechCorp Soluções",
  "datas": {
    "inicio": "01/03/2026",
    "termino_previsto": "30/06/2026"
  },
  "valores": {
    "contratado": 7500.00,
    "pago": 3000.00,
    "pendente": 4500.00,
    "percentual_pago": 40.0
  },
  "marcos": [
    {
      "descricao": "Entrega do backend",
      "valor": 2000.00,
      "vencimento": "15/04/2026",
      "situacao": "Pago",
      "pago_em": "10/04/2026"
    }
  ]
}
```

**Regras:**
- `projeto` → `projects.title` via `contract → project`
- `freelancer` → `users.name` via `contract → freelancer → user`
- `contratante` → `companies.company_name` via `contract → company`
- `datas.*` → `contracts.start_date` e `contracts.end_date` no formato `d/m/Y`
- `valores.pago` → `SUM(payments.amount)` onde `status = 'completed'`
- `valores.pendente` → `total_value - pago` (calculado)
- `valores.percentual_pago` → `(pago / contratado) * 100` (calculado)
- `marcos[].descricao` → `milestones.title`
- `marcos[].vencimento` → `milestones.due_date` no formato `d/m/Y`
- `marcos[].situacao` → enum `milestones.status` traduzido
- `marcos[].pago_em` → `payments.paid_at` no formato `d/m/Y` (null se não pago)
- Retorna 404 se o contrato não existir
