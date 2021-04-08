<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $casts = [
      'appointments_last_fetched' => 'datetime',
        'appointments_last_modified' => 'datetime',
        'appointments' => 'json',
        'appointment_types' => 'json',
        'appointment_vaccine_types' => 'json',
    ];
}
