<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'email',
        'password',
        'country',
        'source',
        'permanent_address',
        'status',
    ];
}
