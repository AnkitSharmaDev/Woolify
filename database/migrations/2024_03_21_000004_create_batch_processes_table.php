<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('batch_processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wool_batch_id')->constrained()->onDelete('cascade');
            $table->foreignId('processing_unit_id')->constrained()->onDelete('cascade');
            $table->string('process_type'); // washing, carding, spinning, dyeing
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->string('status');
            $table->json('parameters')->nullable(); // Process-specific parameters
            $table->text('notes')->nullable();
            $table->json('quality_checks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batch_processes');
    }
};