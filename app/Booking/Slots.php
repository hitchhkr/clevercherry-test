<?php

namespace App\Booking;

use Carbon\Carbon;
use Exception;

class Slots
{
    private const SLOT = 15;
    private const START = 9;
    private const END = 17;
    private const CLOSED = [6, 7];

    /**
     * @var Carbon
     */
    public $date;
    /**
     * @var int
     */
    public $workingDayMinutes;
    /**
     * @var int
     */
    public $blocks;

    private static $startDateTime;

    public function __construct(string $date)
    {
        $this->date = Carbon::parse($date);
        $this->workingDayMinutes();
        $this->workingDayBlocks();

        self::$startDateTime = $this->date->addHours(self::START);

        if (!$this->checkIfOpen()) {
            throw new Exception('closed for the day');
        }
    }

    /**
     * @return Slots
     */
    private function workingDayMinutes(): Slots
    {
        $this->workingDayMinutes = (self::END - self::START) * 60;
        return $this;
    }

    /**
     * @return Slots
     */
    private function workingDayBlocks(): Slots
    {
        $this->blocks = $this->workingDayMinutes / self::SLOT;
        return $this;
    }

    /**
     * @return boolean
     */
    private function checkIfOpen(): bool
    {
        if (in_array($this->date->dayOfWeekIso, self::CLOSED)) {
            return false;
        }

        return true;
    }

    /**
     * @return Carbon
     */
    public static function getStart(): Carbon
    {
        return self::$startDateTime;
    }

    /**
     * @return integer
     */
    public static function getSlot(): int
    {
        return self::SLOT;
    }
}
