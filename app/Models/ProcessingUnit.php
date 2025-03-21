<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessingUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'unit_name',
        'registration_number',
        'description',
        'location',
        'latitude',
        'longitude',
        'processing_capabilities',
        'daily_capacity',
        'certifications',
        'status',
    ];

    protected $casts = [
        'processing_capabilities' => 'array',
        'certifications' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function batchProcesses()
    {
        return $this->hasMany(BatchProcess::class);
    }

    public function certifications()
    {
        return $this->morphMany(QualityCertification::class, 'certifiable');
    }
}