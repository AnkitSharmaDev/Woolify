<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'registration_number',
        'description',
        'location',
        'latitude',
        'longitude',
        'service_areas',
        'certifications',
        'status',
    ];

    protected $casts = [
        'service_areas' => 'array',
        'certifications' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }

    public function certifications()
    {
        return $this->morphMany(QualityCertification::class, 'certifiable');
    }
}