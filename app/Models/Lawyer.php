<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\City;
use App\Models\Service;

class Lawyer extends Model
{
    use HasFactory;

    protected $table = 'lawyers';

    protected $fillable = [
        'user_id',
        'city_id',
        'service_id',
        'experience',
        'bio',
        'fee',
        'image',
        'office_address',
        'qualifications',
    ];

    protected $casts = [
        'qualifications' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function schedules()
    {
        return $this->hasMany(LawyerSchedule::class);
    }
}
