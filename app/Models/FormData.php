<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    use HasFactory;

    protected $table = 'form_data';

    protected $fillable = [
        'name',
        'dob',
        'frequency',
        'daily_frequency',
    ];

    protected $dates = [
        'dob',
    ];
}
