<?php

namespace App\Responsers\Freelancer;

use App\Enums\FreelancerStatusEnum;
use App\Models\Freelancer;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;

class ListAvailableResponser
{
    /**
     * @param Collection<int, Freelancer> $freelancers
     */
    public function __construct(
        public Collection $freelancers
    ) {}

    public function response(): array
    {
        return $this->mountResponse();
    }

    private function mountResponse(): array
    {
        return $this->freelancers->map(function ($f) {
            return [
                'id' => $f->id,
                'nome_completo' => $f->user->name,
                'localizacao' => $f->city . ' / ' . $f->state,
                'valor_hora' => Number::currency($f->hourly_rate, 'BRL', 'pt_BR'),
                'nota' => (float) number_format($f->rating_average, 1),
                'avaliacoes' => $f->total_reviews,
                'habilidades' => $this->mountSkills($f->skills),
                'disponibilidade' => FreelancerStatusEnum::from($f->availability_status)->label(),
            ];
        })->all();
    }

    private function mountSkills(Collection $skills): array
    {
        return array_column($skills->toArray(), 'name');
    }
}