<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentType extends Model
{
    use HasFactory;

    /**
     * @return integer
     */
    public function getBlocks(): int
    {
        return $this->blocks;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
