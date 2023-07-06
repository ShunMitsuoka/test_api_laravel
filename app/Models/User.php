<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth',
        'company',
        'department',
        'hobby',
        'recommended_restaurant',
        'favorite_place',
    ];
}
