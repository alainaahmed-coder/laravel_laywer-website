<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    use HasFactory;

    protected $table = 'lawyers';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'specialization',
        'city',
        'experience',
        'bio',
        'fee',
        'image',
        'is_verified',
        'office_address',
        'qualifications',
        'rating',
        'total_reviews',
        'is_approved',
        'is_active',
    ];

    protected $casts = [
        'qualifications' => 'array',
        'is_verified' => 'boolean',
        'is_approved' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}