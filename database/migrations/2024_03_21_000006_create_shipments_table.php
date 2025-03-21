<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wool_batch_id')->constrained()->onDelete('cascade');
            $table->foreignId('distributor_id')->constrained()->onDelete('cascade');
            $table->string('tracking_number')->unique();
            $table->string('origin_type'); // farm or processing_unit
            $table->unsignedBigInteger('origin_id');
            $table->string('destination_type'); // processing_unit or customer
            $table->unsignedBigInteger('destination_id');
            $table->dateTime('pickup_date');
            $table->dateTime('estimated_delivery');
            $table->dateTime('actual_delivery')->nullable();
            $table->string('status');
            $table->json('route_details')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};