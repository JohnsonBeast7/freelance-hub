<?php 

namespace App\Enums;

enum FreelancerStatusEnum: string
{
    case AVAILABLE = 'available';
    case BUSY = 'busy';
    case UNAVAILABLE = 'unavailable';

    public function label()
    {
        return match($this) {
            self::AVAILABLE => 'Disponível',
            self::BUSY => 'Ocupado',
            self::UNAVAILABLE => 'Indisponível',
        };
    }
}