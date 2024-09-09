<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Building extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'radius_km',
        'radius_km',
        'time_in',
        'time_out',
    ];
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
