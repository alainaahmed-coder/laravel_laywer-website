<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class services extends Model
{
     use HasFactory;

    protected $table = 'services';
    protected $fillable = ['name'];
}
