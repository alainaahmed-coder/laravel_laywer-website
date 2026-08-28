<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawyerSchedule extends Model
{
    use HasFactory;

    protected $table = 'lawyer_schedules';

    protected $fillable = [
        'lawyer_id',
        'day',
        'start_time',
        'end_time',
        'slot_duration',
    ];

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
}