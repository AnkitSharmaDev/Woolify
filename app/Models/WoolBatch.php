<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WoolBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_id',
        'batch_number',
        'wool_type',
        'weight',
        'quality_grade',
        'quality_parameters',
        'shearing_date',
        'status',
        'notes',
        'certificates',
    ];

    protected $casts = [
        'quality_parameters' => 'array',
        'certificates' => 'array',
        'shearing_date' => 'date',
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function processes()
    {
        return $this->hasMany(BatchProcess::class);
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