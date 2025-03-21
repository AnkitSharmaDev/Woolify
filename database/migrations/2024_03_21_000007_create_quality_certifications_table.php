<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quality_certifications', function (Blueprint $table) {
            $table->id();
            $table->morphs('certifiable'); // For farms, processing_units, or wool_batches
            $table->string('certificate_number')->unique();
            $table->string('certificate_type');
            $table->string('issuing_authority');
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->string('document_path');
            $table->json('parameters')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quality_certifications');
    }
};