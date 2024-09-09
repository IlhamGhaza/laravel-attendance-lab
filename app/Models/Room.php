<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [ 'building_id', 'floor', 'room_number', 'lab_id','status'];

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
