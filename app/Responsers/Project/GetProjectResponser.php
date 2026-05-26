<?php

namespace App\Responsers\Project;

use App\Enums\ProjectStatusEnum;
use App\Models\Project;
use Illuminate\Support\Collection;

class GetProjectResponser
{
    public function __construct(
        public Project $project
    ) {}

    public function response(): array
    {
        return $this->mountResponse();
    }

    private function mountResponse(): array
    {
        $min = (float) $this->project->budget_min;
        $max = (float) $this->project->budget_max;

        return [
            'identificador' => $this->project->id,
            'titulo' => $this->project->title,
            'empresa' => $this->project->company->company_name,
            'email_empresa' => $this->project->company->user->email,
            'categoria' => $this->project->category->name,
            'orcamento' => [
                'minimo' => $min,
                'maximo' => $max,
                'faixa' => $this->mountBudgetRange($min, $max),
            ],
            'prazo_limite' => $this->project->deadline->format('d/m/Y'),
            'total_propostas' => $this->project->bids_count,
            'menor_proposta' => (float) $this->project->min_bid,
            'maior_proposta' => (float) $this->project->max_bid,
            'habilidades_requeridas' => $this->mountSkills($this->project->skills),
            'situacao' => ProjectStatusEnum::from($this->project->status)->label(),
        ];
    }

    private function mountBudgetRange(float $min, float $max): string
    {
        return 'R$ ' . number_format($min, 0, ',', '.') . ' - R$ ' . number_format($max, 0, ',', '.');
    }

    private function mountSkills(Collection $skills): array
    {
        return array_column($skills->toArray(), 'name');
    }
}