<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'farm_name',
        'registration_number',
        'description',
        'location',
        'latitude',
        'longitude',
        'wool_types',
        'capacity',
        'certification_documents',
        'status',
    ];

    protected $casts = [
        'wool_types' => 'array',
        'certification_documents' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function woolBatches()
    {
        return $this->hasMany(WoolBatch::class);
    }

    public function certifications()
    {
        return $this->morphMany(QualityCertification::class, 'certifiable');
    }
}