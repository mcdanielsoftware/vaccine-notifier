<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $guarded = false;

    public const MILES_PER_METER = 0.000621371;

    public const METERS_PER_MILE = 1609.34;



    protected $casts = [
      'appointments_last_fetched' => 'datetime',
        'appointments_last_modified' => 'datetime',
        'appointments' => 'json',
        'appointment_types' => 'json',
        'appointment_vaccine_types' => 'json',
    ];

    public function scopeWhereWithinDistance($query, $long, $lat, $distanceInMiles)
    {

        $radiusInMeters = $distanceInMiles * self::METERS_PER_MILE;

        $query->whereRaw('ST_Distance_Sphere(
            Point(sites.long, sites.lat),
            Point(?, ?)
        ) <= ?', [$long, $lat, $radiusInMeters]);
    }

    public function getDistanceAttribute($value)
    {
        return $value * self::MILES_PER_METER;
    }
}
