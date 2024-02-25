<?php

namespace App\Http\Controllers;

use App\Booking\Block;
use App\Booking\Slots;
use App\Models\AppointmentType;
use Carbon\Carbon;

class Availability extends Controller
{
    public function index(string $date, int $type)
    {
        try {
            $slots = new Slots($date);
            $start = $slots->getStart();

            $a_type = AppointmentType::find($type);
            $blocks_needed = $a_type->getBlocks();

            $data['type'] = $a_type;

            for ($i = 0; $i < $slots->blocks - 1; $i++) {
                $i > 0 ? $start->addMinutes($slots::getSlot()) : $start;
            //  We would obviously check this against any saved bookings in reality
                $data['dates'][] = Block::buildBlock($start, $blocks_needed);
            }

            return response(json_encode([
                'date' => Carbon::now()->format('c'),
                'msg' => sprintf('Appoitnments on %s for %s', $date, $a_type->getTitle()),
                'data' => $data
            ]), 200)
            ->header('Content-Type', 'application/json');
        } catch (\Exception $e) {
            return response(json_encode([
                'date' => Carbon::now()->format('c'),
                'msg' => $e->getMessage()
            ]), 401)
            ->header('Content-Type', 'application/json');
        }
    }
}
