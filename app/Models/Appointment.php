<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'lawyer_id',
        'customer_id',
        'appointment_date',
        'appointment_time',
        'meeting_type',
        'case_summary',
        'status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}