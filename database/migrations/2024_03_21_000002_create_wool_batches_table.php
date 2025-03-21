<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wool_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id')->constrained()->onDelete('cascade');
            $table->string('batch_number')->unique();
            $table->string('wool_type');
            $table->decimal('weight', 10, 2);
            $table->string('quality_grade');
            $table->json('quality_parameters')->nullable();
            $table->date('shearing_date');
            $table->string('status')->default('at_farm');
            $table->text('notes')->nullable();
            $table->json('certificates')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wool_batches');
    }
};