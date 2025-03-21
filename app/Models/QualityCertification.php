<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityCertification extends Model
{
    use HasFactory;

    protected $fillable = [
        'certifiable_type',
        'certifiable_id',
        'certificate_number',
        'certificate_type',
        'issuing_authority',
        'issue_date',
        'expiry_date',
        'document_path',
        'parameters',
        'status',
    ];

    protected $casts = [
        'parameters' => 'array',
        'issue_date' => 'date',
        'expiry_date' => 'date',
    ];

    public function certifiable()
    {
        return $this->morphTo();
    }
}