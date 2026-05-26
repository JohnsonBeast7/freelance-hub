<?php 

namespace App\Enums;

enum ProjectStatusEnum: string
{
    case OPEN = 'open';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function label()
    {
        return match($this) {
            self::OPEN => 'Aberto para propostas',
            self::IN_PROGRESS => 'Em progresso',
            self::COMPLETED => 'Concluído',
            self::CANCELLED => 'Cancelado',
        };
    }
}