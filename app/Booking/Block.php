<?php

namespace App\Booking;

use Carbon\Carbon;

class Block
{
    /**
     * @param Carbon $start
     * @param integer $blocks
     * @return array
     */
    public static function buildBlock(Carbon $start, int $blocks): array
    {
        $end = $start->format('c');
        return [
            'start' => $start->format('c'),
            'end' => Carbon::parse($end)->addMinutes(Slots::getSlot() * $blocks)->format('c')
        ];
    }
}
