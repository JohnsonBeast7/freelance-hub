<?php

namespace Database\Seeders;

use App\Models\Bid;
use App\Models\Category;
use App\Models\Company;
use App\Models\Contract;
use App\Models\Freelancer;
use App\Models\Milestone;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Review;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================================
        // 1. CATEGORIES (5)
        // =====================================================
        $categoriesData = [
            ['name' => 'Desenvolvimento Web', 'slug' => 'desenvolvimento-web'],
            ['name' => 'Desenvolvimento Mobile', 'slug' => 'desenvolvimento-mobile'],
            ['name' => 'Design', 'slug' => 'design'],
            ['name' => 'Marketing Digital', 'slug' => 'marketing-digital'],
            ['name' => 'DevOps', 'slug' => 'devops'],
        ];

        $categories = [];
        foreach ($categoriesData as $data) {
            $categories[$data['slug']] = Category::create($data);
        }

        // =====================================================
        // 2. SKILLS (15 distributed across categories)
        // =====================================================
        $skillsData = [
            // Desenvolvimento Web (3)
            ['category_id' => $categories['desenvolvimento-web']->id, 'name' => 'Laravel', 'slug' => 'laravel'],
            ['category_id' => $categories['desenvolvimento-web']->id, 'name' => 'Vue.js', 'slug' => 'vuejs'],
            ['category_id' => $categories['desenvolvimento-web']->id, 'name' => 'React', 'slug' => 'react'],
            // Desenvolvimento Mobile (3)
            ['category_id' => $categories['desenvolvimento-mobile']->id, 'name' => 'Flutter', 'slug' => 'flutter'],
            ['category_id' => $categories['desenvolvimento-mobile']->id, 'name' => 'React Native', 'slug' => 'react-native'],
            ['category_id' => $categories['desenvolvimento-mobile']->id, 'name' => 'Swift', 'slug' => 'swift'],
            // Design (3)
            ['category_id' => $categories['design']->id, 'name' => 'UI/UX Design', 'slug' => 'ui-ux-design'],
            ['category_id' => $categories['design']->id, 'name' => 'Figma', 'slug' => 'figma'],
            ['category_id' => $categories['design']->id, 'name' => 'Adobe Illustrator', 'slug' => 'adobe-illustrator'],
            // Marketing Digital (3)
            ['category_id' => $categories['marketing-digital']->id, 'name' => 'SEO', 'slug' => 'seo'],
            ['category_id' => $categories['marketing-digital']->id, 'name' => 'Google Ads', 'slug' => 'google-ads'],
            ['category_id' => $categories['marketing-digital']->id, 'name' => 'Social Media', 'slug' => 'social-media'],
            // DevOps (3)
            ['category_id' => $categories['devops']->id, 'name' => 'Docker', 'slug' => 'docker'],
            ['category_id' => $categories['devops']->id, 'name' => 'AWS', 'slug' => 'aws'],
            ['category_id' => $categories['devops']->id, 'name' => 'CI/CD', 'slug' => 'cicd'],
        ];

        $skills = [];
        foreach ($skillsData as $data) {
            $skills[$data['slug']] = Skill::create($data);
        }

        // =====================================================
        // 3. USERS + COMPANIES (5 companies)
        // =====================================================
        $companiesData = [
            [
                'user' => ['name' => 'TechVision Ltda', 'email' => 'contato@techvision.com.br', 'password' => Hash::make('password')],
                'company' => ['company_name' => 'TechVision Ltda', 'cnpj' => '12.345.678/0001-90', 'description' => 'Empresa especializada em soluções digitais inovadoras para o mercado B2B.', 'website' => 'https://techvision.com.br', 'city' => 'São Paulo', 'state' => 'SP'],
            ],
            [
                'user' => ['name' => 'InovaCorp', 'email' => 'ti@inovacorp.com.br', 'password' => Hash::make('password')],
                'company' => ['company_name' => 'InovaCorp', 'cnpj' => '98.765.432/0001-10', 'description' => 'Startup de tecnologia focada em transformação digital de PMEs.', 'website' => 'https://inovacorp.com.br', 'city' => 'Rio de Janeiro', 'state' => 'RJ'],
            ],
            [
                'user' => ['name' => 'Digital Minds', 'email' => 'projetos@digitalminds.com.br', 'password' => Hash::make('password')],
                'company' => ['company_name' => 'Digital Minds', 'cnpj' => '55.123.456/0001-33', 'description' => 'Agência digital full-service com foco em e-commerce e marketing.', 'website' => 'https://digitalminds.com.br', 'city' => 'Curitiba', 'state' => 'PR'],
            ],
            [
                'user' => ['name' => 'CloudBase Systems', 'email' => 'dev@cloudbase.io', 'password' => Hash::make('password')],
                'company' => ['company_name' => 'CloudBase Systems', 'cnpj' => '77.890.123/0001-55', 'description' => 'Empresa de infraestrutura em nuvem e DevOps para scale-ups.', 'website' => 'https://cloudbase.io', 'city' => 'Belo Horizonte', 'state' => 'MG'],
            ],
            [
                'user' => ['name' => 'AppFactory Brasil', 'email' => 'contato@appfactory.com.br', 'password' => Hash::make('password')],
                'company' => ['company_name' => 'AppFactory Brasil', 'cnpj' => '33.456.789/0001-22', 'description' => 'Fábrica de aplicativos móveis nativos e híbridos.', 'website' => 'https://appfactory.com.br', 'city' => 'Porto Alegre', 'state' => 'RS'],
            ],
        ];

        $companies = [];
        foreach ($companiesData as $data) {
            $user = User::create($data['user']);
            $company = Company::create(array_merge($data['company'], ['user_id' => $user->id]));
            $companies[] = $company;
        }

        // =====================================================
        // 4. USERS + FREELANCERS (5 freelancers)
        // =====================================================
        $freelancersData = [
            [
                'user' => ['name' => 'Carlos Eduardo Mendes', 'email' => 'carlos.mendes@gmail.com', 'password' => Hash::make('password')],
                'freelancer' => ['bio' => 'Desenvolvedor Laravel sênior com 8 anos de experiência. Especialista em APIs REST e arquitetura de microsserviços.', 'hourly_rate' => 150.00, 'availability_status' => 'available', 'rating_average' => 4.85, 'total_reviews' => 47, 'city' => 'São Paulo', 'state' => 'SP'],
                'skills' => ['laravel', 'vuejs', 'docker'],
            ],
            [
                'user' => ['name' => 'Ana Paula Rodrigues', 'email' => 'ana.rodrigues@gmail.com', 'password' => Hash::make('password')],
                'freelancer' => ['bio' => 'Designer UX/UI apaixonada por criar experiências digitais intuitivas e acessíveis. Certificada pelo Google UX Design.', 'hourly_rate' => 120.00, 'availability_status' => 'available', 'rating_average' => 4.92, 'total_reviews' => 63, 'city' => 'Rio de Janeiro', 'state' => 'RJ'],
                'skills' => ['ui-ux-design', 'figma', 'adobe-illustrator'],
            ],
            [
                'user' => ['name' => 'Roberto Silva Santos', 'email' => 'roberto.santos@outlook.com', 'password' => Hash::make('password')],
                'freelancer' => ['bio' => 'Especialista em desenvolvimento mobile com Flutter e React Native. +50 apps publicados na App Store e Play Store.', 'hourly_rate' => 130.00, 'availability_status' => 'busy', 'rating_average' => 4.70, 'total_reviews' => 31, 'city' => 'Florianópolis', 'state' => 'SC'],
                'skills' => ['flutter', 'react-native', 'react'],
            ],
            [
                'user' => ['name' => 'Juliana Costa Lima', 'email' => 'juliana.lima@gmail.com', 'password' => Hash::make('password')],
                'freelancer' => ['bio' => 'Especialista em marketing digital e growth hacking. Mais de R$ 5M gerenciados em campanhas Google e Meta Ads.', 'hourly_rate' => 100.00, 'availability_status' => 'available', 'rating_average' => 4.60, 'total_reviews' => 28, 'city' => 'Campinas', 'state' => 'SP'],
                'skills' => ['seo', 'google-ads', 'social-media'],
            ],
            [
                'user' => ['name' => 'Marcos Vinícius Pereira', 'email' => 'marcos.pereira@gmail.com', 'password' => Hash::make('password')],
                'freelancer' => ['bio' => 'Engenheiro DevOps com expertise em AWS, Docker e Kubernetes. Certificações AWS Solutions Architect e CKA.', 'hourly_rate' => 160.00, 'availability_status' => 'available', 'rating_average' => 4.78, 'total_reviews' => 22, 'city' => 'Brasília', 'state' => 'DF'],
                'skills' => ['docker', 'aws', 'cicd'],
            ],
        ];

        $freelancers = [];
        foreach ($freelancersData as $data) {
            $user = User::create($data['user']);
            $freelancer = Freelancer::create(array_merge($data['freelancer'], ['user_id' => $user->id]));

            $skillAttach = [];
            foreach ($data['skills'] as $skillSlug) {
                $skillAttach[$skills[$skillSlug]->id] = ['proficiency_level' => 'expert'];
            }
            $freelancer->skills()->attach($skillAttach);

            $freelancers[] = $freelancer;
        }

        // =====================================================
        // 5. PROJECTS (10 open projects)
        // =====================================================
        $projectsData = [
            [
                'company_id' => $companies[0]->id,
                'category_id' => $categories['desenvolvimento-web']->id,
                'title' => 'Desenvolvimento de Plataforma SaaS B2B',
                'description' => 'Precisamos de um desenvolvedor experiente para construir uma plataforma SaaS completa com multi-tenancy, painel administrativo, relatórios e integração com APIs de pagamento (Stripe/PagSeguro). Stack: Laravel + Vue.js + PostgreSQL.',
                'budget_min' => 15000.00,
                'budget_max' => 25000.00,
                'deadline' => now()->addMonths(4)->format('Y-m-d'),
                'status' => 'open',
                'skills' => ['laravel', 'vuejs'],
            ],
            [
                'company_id' => $companies[1]->id,
                'category_id' => $categories['design']->id,
                'title' => 'Redesign Completo de Identidade Visual e App',
                'description' => 'Nossa startup precisa de um redesign completo: nova identidade visual, design system, e prototipação do aplicativo mobile. Entregas esperadas: brand guidelines, componentes Figma e protótipo navegável.',
                'budget_min' => 8000.00,
                'budget_max' => 14000.00,
                'deadline' => now()->addMonths(2)->format('Y-m-d'),
                'status' => 'open',
                'skills' => ['ui-ux-design', 'figma'],
            ],
            [
                'company_id' => $companies[2]->id,
                'category_id' => $categories['marketing-digital']->id,
                'title' => 'Gestão de Tráfego Pago e SEO para E-commerce',
                'description' => 'E-commerce de moda feminina busca especialista para gerenciar campanhas Google Shopping, Meta Ads e estratégia SEO. Budget mensal de anúncios: R$ 20.000. Meta: aumentar ROI em 40% em 6 meses.',
                'budget_min' => 3500.00,
                'budget_max' => 6000.00,
                'deadline' => now()->addMonths(6)->format('Y-m-d'),
                'status' => 'open',
                'skills' => ['seo', 'google-ads'],
            ],
            [
                'company_id' => $companies[3]->id,
                'category_id' => $categories['devops']->id,
                'title' => 'Migração de Infraestrutura para AWS e Setup CI/CD',
                'description' => 'Empresa em crescimento precisa migrar infraestrutura on-premise para AWS. Escopo inclui: arquitetura de VPC, ECS/Fargate, RDS, ElastiCache, pipeline CI/CD com GitHub Actions e monitoramento com CloudWatch.',
                'budget_min' => 12000.00,
                'budget_max' => 20000.00,
                'deadline' => now()->addMonths(3)->format('Y-m-d'),
                'status' => 'open',
                'skills' => ['aws', 'docker', 'cicd'],
            ],
            [
                'company_id' => $companies[4]->id,
                'category_id' => $categories['desenvolvimento-mobile']->id,
                'title' => 'App de Delivery com Rastreamento em Tempo Real',
                'description' => 'Plataforma de delivery regional busca desenvolvedor para criar app Flutter (iOS + Android) com rastreamento em tempo real via WebSocket, integração com Google Maps e sistema de pagamento in-app.',
                'budget_min' => 18000.00,
                'budget_max' => 30000.00,
                'deadline' => now()->addMonths(5)->format('Y-m-d'),
                'status' => 'open',
                'skills' => ['flutter', 'react-native'],
            ],
            [
                'company_id' => $companies[0]->id,
                'category_id' => $categories['desenvolvimento-web']->id,
                'title' => 'API RESTful para Integração com ERPs',
                'description' => 'Necessitamos de uma API REST robusta em Laravel para integrar nosso sistema interno com ERPs SAP e TOTVS. Deve incluir autenticação OAuth2, rate limiting, logs detalhados e documentação Swagger.',
                'budget_min' => 6000.00,
                'budget_max' => 10000.00,
                'deadline' => now()->addMonths(2)->addWeeks(2)->format('Y-m-d'),
                'status' => 'open',
                'skills' => ['laravel'],
            ],
            [
                'company_id' => $companies[1]->id,
                'category_id' => $categories['design']->id,
                'title' => 'Criação de Materiais Gráficos para Campanha',
                'description' => 'Agência precisa de designer para criar peças gráficas para campanha de lançamento de produto: posts para redes sociais (feed e stories), banners para Google Display, e-mail marketing e landing page.',
                'budget_min' => 2500.00,
                'budget_max' => 4500.00,
                'deadline' => now()->addMonths(1)->format('Y-m-d'),
                'status' => 'open',
                'skills' => ['adobe-illustrator', 'figma'],
            ],
            [
                'company_id' => $companies[2]->id,
                'category_id' => $categories['marketing-digital']->id,
                'title' => 'Estratégia e Gestão de Redes Sociais',
                'description' => 'Empresa do setor financeiro busca especialista para gerenciar presença nas redes sociais (LinkedIn, Instagram, Twitter/X). Inclui criação de conteúdo editorial, gestão de crise e relatórios mensais.',
                'budget_min' => 2000.00,
                'budget_max' => 3500.00,
                'deadline' => now()->addMonths(3)->format('Y-m-d'),
                'status' => 'open',
                'skills' => ['social-media'],
            ],
            [
                'company_id' => $companies[3]->id,
                'category_id' => $categories['devops']->id,
                'title' => 'Containerização e Orquestração com Kubernetes',
                'description' => 'Precisamos containerizar todos nossos microserviços (12 apps) e configurar orquestração com Kubernetes (EKS na AWS). Inclui Helm charts, HPA, monitoramento com Prometheus/Grafana e alertas.',
                'budget_min' => 10000.00,
                'budget_max' => 18000.00,
                'deadline' => now()->addMonths(3)->addWeeks(2)->format('Y-m-d'),
                'status' => 'open',
                'skills' => ['docker', 'aws'],
            ],
            [
                'company_id' => $companies[4]->id,
                'category_id' => $categories['desenvolvimento-mobile']->id,
                'title' => 'App de Telemedicina com Videochamada',
                'description' => 'Clínica médica precisa de app de telemedicina: agendamento online, videochamada via WebRTC, prontuário digital, prescrição eletrônica e integração com planos de saúde. Disponível para iOS e Android.',
                'budget_min' => 25000.00,
                'budget_max' => 45000.00,
                'deadline' => now()->addMonths(6)->format('Y-m-d'),
                'status' => 'open',
                'skills' => ['flutter', 'react-native'],
            ],
        ];

        $projects = [];
        foreach ($projectsData as $data) {
            $skillSlugs = $data['skills'];
            unset($data['skills']);
            $project = Project::create($data);

            $skillIds = array_map(fn($slug) => $skills[$slug]->id, $skillSlugs);
            $project->skills()->attach($skillIds);

            $projects[] = $project;
        }

        // =====================================================
        // 6. BIDS (freelancers bid on projects)
        // =====================================================
        $bidsData = [
            ['project_id' => $projects[0]->id, 'freelancer_id' => $freelancers[0]->id, 'proposed_value' => 20000.00, 'estimated_days' => 90, 'cover_letter' => 'Tenho ampla experiência em projetos SaaS com Laravel e Vue.js. Já desenvolvi 3 plataformas multi-tenancy de grande escala. Posso entregar um MVP sólido em 3 meses com código limpo e documentado.', 'status' => 'accepted'],
            ['project_id' => $projects[5]->id, 'freelancer_id' => $freelancers[0]->id, 'proposed_value' => 8500.00, 'estimated_days' => 45, 'cover_letter' => 'Integração com ERPs é minha especialidade. Tenho experiência com SAP e TOTVS, já implementei dezenas de conectores REST. Posso iniciar imediatamente e entregar com documentação completa.', 'status' => 'pending'],
            ['project_id' => $projects[1]->id, 'freelancer_id' => $freelancers[1]->id, 'proposed_value' => 12000.00, 'estimated_days' => 45, 'cover_letter' => 'Sou especialista em identidade visual para startups. Meu portfólio inclui redesigns para 15+ empresas de tecnologia. Entregarei um design system completo e moderno que reflete a essência da sua marca.', 'status' => 'accepted'],
            ['project_id' => $projects[6]->id, 'freelancer_id' => $freelancers[1]->id, 'proposed_value' => 3800.00, 'estimated_days' => 20, 'cover_letter' => 'Tenho experiência criando campanhas visuais completas para lançamentos de produto. Já trabalhei com diversas agências e entrego todas as peças em formatos editáveis com alta qualidade.', 'status' => 'pending'],
            ['project_id' => $projects[4]->id, 'freelancer_id' => $freelancers[2]->id, 'proposed_value' => 24000.00, 'estimated_days' => 120, 'cover_letter' => 'Já desenvolvi 3 apps de delivery com Flutter e integração de mapas em tempo real. Tenho experiência com WebSocket para rastreamento e gateways de pagamento nacionais. Posso fazer uma demo da arquitetura.', 'status' => 'accepted'],
            ['project_id' => $projects[9]->id, 'freelancer_id' => $freelancers[2]->id, 'proposed_value' => 38000.00, 'estimated_days' => 150, 'cover_letter' => 'Telemedicina é uma área que tenho experiência. Já desenvolvi 2 apps médicos com videochamada WebRTC e integração com operadoras de saúde. Podemos conversar sobre os requisitos técnicos específicos.', 'status' => 'pending'],
            ['project_id' => $projects[2]->id, 'freelancer_id' => $freelancers[3]->id, 'proposed_value' => 5000.00, 'estimated_days' => 180, 'cover_letter' => 'Gerencio mais de R$ 500K/mês em anúncios para e-commerces de moda. Tenho estratégias comprovadas para Google Shopping e Meta Ads que aumentam o ROAS em 60-80%. Posso apresentar cases de sucesso similares.', 'status' => 'accepted'],
            ['project_id' => $projects[7]->id, 'freelancer_id' => $freelancers[3]->id, 'proposed_value' => 3000.00, 'estimated_days' => 90, 'cover_letter' => 'Tenho experiência gerenciando redes sociais para o setor financeiro, com ênfase em conteúdo de valor e gestão de crise. Meu método editorial aumenta o engajamento orgânico em 150% em média.', 'status' => 'pending'],
            ['project_id' => $projects[3]->id, 'freelancer_id' => $freelancers[4]->id, 'proposed_value' => 16000.00, 'estimated_days' => 60, 'cover_letter' => 'Migrei mais de 20 empresas para AWS com zero downtime. Sou certificado AWS Solutions Architect Professional e tenho experiência específica com ECS/Fargate e RDS. Posso fazer uma análise da infraestrutura atual antes de propor a arquitetura final.', 'status' => 'accepted'],
            ['project_id' => $projects[8]->id, 'freelancer_id' => $freelancers[4]->id, 'proposed_value' => 15000.00, 'estimated_days' => 75, 'cover_letter' => 'Tenho certificação CKA (Certified Kubernetes Administrator) e experiência containerizando sistemas legados complexos. Já fiz setup de EKS com mais de 100 pods em produção. Podemos agendar uma call técnica para detalhar o escopo.', 'status' => 'pending'],
        ];

        $bids = [];
        foreach ($bidsData as $data) {
            $bids[] = Bid::create($data);
        }

        // =====================================================
        // 7. CONTRACTS (3 contracts from accepted bids)
        // =====================================================
        $contractsData = [
            [
                'project_id' => $bids[0]->project_id,
                'bid_id' => $bids[0]->id,
                'freelancer_id' => $bids[0]->freelancer_id,
                'company_id' => $companies[0]->id,
                'total_value' => 20000.00,
                'start_date' => now()->subMonths(2)->format('Y-m-d'),
                'end_date' => now()->addMonths(2)->format('Y-m-d'),
                'status' => 'active',
                'milestones' => [
                    ['title' => 'Arquitetura e Setup Inicial', 'description' => 'Definição da arquitetura multi-tenancy, setup do ambiente de desenvolvimento e criação da estrutura base do projeto.', 'value' => 4000.00, 'due_date' => now()->subMonths(1)->addWeeks(2)->format('Y-m-d'), 'status' => 'paid'],
                    ['title' => 'Módulo de Autenticação e Multi-tenancy', 'description' => 'Implementação do sistema de autenticação, gestão de tenants, roles e permissões.', 'value' => 5000.00, 'due_date' => now()->subWeeks(2)->format('Y-m-d'), 'status' => 'completed'],
                    ['title' => 'Dashboard e Relatórios', 'description' => 'Desenvolvimento do painel administrativo com gráficos, relatórios exportáveis e filtros avançados.', 'value' => 6000.00, 'due_date' => now()->addMonths(1)->format('Y-m-d'), 'status' => 'in_progress'],
                    ['title' => 'Integração de Pagamentos e Deploy', 'description' => 'Integração com Stripe e PagSeguro, testes de carga e deploy na infraestrutura de produção.', 'value' => 5000.00, 'due_date' => now()->addMonths(2)->format('Y-m-d'), 'status' => 'pending'],
                ],
            ],
            [
                'project_id' => $bids[2]->project_id,
                'bid_id' => $bids[2]->id,
                'freelancer_id' => $bids[2]->freelancer_id,
                'company_id' => $companies[1]->id,
                'total_value' => 12000.00,
                'start_date' => now()->subMonths(1)->format('Y-m-d'),
                'end_date' => now()->addMonths(1)->format('Y-m-d'),
                'status' => 'active',
                'milestones' => [
                    ['title' => 'Pesquisa e Briefing Visual', 'description' => 'Workshop de branding, moodboard, definição de paleta de cores, tipografia e tom de voz.', 'value' => 2500.00, 'due_date' => now()->subWeeks(3)->format('Y-m-d'), 'status' => 'paid'],
                    ['title' => 'Identidade Visual e Brand Guidelines', 'description' => 'Criação do logotipo final, manual de identidade visual completo e aplicações.', 'value' => 4500.00, 'due_date' => now()->subWeeks(1)->format('Y-m-d'), 'status' => 'paid'],
                    ['title' => 'Design System e Protótipo', 'description' => 'Criação do design system no Figma com todos os componentes e protótipo navegável do app.', 'value' => 5000.00, 'due_date' => now()->addMonths(1)->format('Y-m-d'), 'status' => 'in_progress'],
                ],
            ],
            [
                'project_id' => $bids[4]->project_id,
                'bid_id' => $bids[4]->id,
                'freelancer_id' => $bids[4]->freelancer_id,
                'company_id' => $companies[4]->id,
                'total_value' => 24000.00,
                'start_date' => now()->subWeeks(3)->format('Y-m-d'),
                'end_date' => now()->addMonths(4)->format('Y-m-d'),
                'status' => 'active',
                'milestones' => [
                    ['title' => 'Prototipação e Arquitetura', 'description' => 'Wireframes detalhados, arquitetura do app e configuração dos ambientes de desenvolvimento.', 'value' => 4000.00, 'due_date' => now()->subWeeks(1)->format('Y-m-d'), 'status' => 'completed'],
                    ['title' => 'MVP: Catálogo e Carrinho', 'description' => 'Telas de listagem de restaurantes, cardápio, carrinho e checkout básico.', 'value' => 7000.00, 'due_date' => now()->addMonths(1)->addWeeks(2)->format('Y-m-d'), 'status' => 'in_progress'],
                    ['title' => 'Rastreamento e Pagamentos', 'description' => 'Integração com Google Maps para rastreamento em tempo real e gateway de pagamento.', 'value' => 8000.00, 'due_date' => now()->addMonths(3)->format('Y-m-d'), 'status' => 'pending'],
                    ['title' => 'Testes, Ajustes e Publicação', 'description' => 'Testes completos, correções de bugs, otimização de performance e publicação nas lojas.', 'value' => 5000.00, 'due_date' => now()->addMonths(4)->format('Y-m-d'), 'status' => 'pending'],
                ],
            ],
        ];

        foreach ($contractsData as $contractData) {
            $milestonesData = $contractData['milestones'];
            unset($contractData['milestones']);

            $contract = Contract::create($contractData);

            // Update project status to in_progress
            Project::where('id', $contract->project_id)->update(['status' => 'in_progress']);

            foreach ($milestonesData as $milestoneData) {
                $milestone = Milestone::create(array_merge($milestoneData, ['contract_id' => $contract->id]));

                // Create payment for paid milestones
                if ($milestone->status === 'paid') {
                    Payment::create([
                        'milestone_id' => $milestone->id,
                        'contract_id' => $contract->id,
                        'amount' => $milestone->value,
                        'payment_method' => 'pix',
                        'transaction_id' => 'TXN-' . strtoupper(Str::random(12)),
                        'status' => 'completed',
                        'paid_at' => $milestone->due_date,
                    ]);
                }
            }
        }

        // =====================================================
        // 8. REVIEWS
        // =====================================================
        $contract1 = Contract::first();
        $companyUser1 = $companies[0]->user;
        $freelancerUser1 = $freelancers[0]->user;

        Review::create([
            'contract_id' => $contract1->id,
            'reviewer_id' => $companyUser1->id,
            'reviewed_id' => $freelancerUser1->id,
            'reviewer_type' => 'company',
            'rating' => 5,
            'comment' => 'Carlos entregou um trabalho excepcional. Código limpo, bem documentado e sempre disponível para ajustes. Recomendo fortemente para projetos Laravel complexos.',
        ]);

        $contract2 = Contract::skip(1)->first();
        $companyUser2 = $companies[1]->user;
        $freelancerUser2 = $freelancers[1]->user;

        Review::create([
            'contract_id' => $contract2->id,
            'reviewer_id' => $companyUser2->id,
            'reviewed_id' => $freelancerUser2->id,
            'reviewer_type' => 'company',
            'rating' => 5,
            'comment' => 'Ana superou todas as expectativas! O novo branding ficou incrível e o design system é completo e fácil de usar. Uma profissional altamente criativa e organizada.',
        ]);

        Review::create([
            'contract_id' => $contract2->id,
            'reviewer_id' => $freelancerUser2->id,
            'reviewed_id' => $companyUser2->id,
            'reviewer_type' => 'freelancer',
            'rating' => 4,
            'comment' => 'Empresa com visão clara do que quer. O briefing poderia ter sido mais detalhado no início, mas ao longo do projeto a comunicação melhorou muito. Ótima parceria.',
        ]);
    }
}
