<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointment_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_id')
                    ->constrained()
                    ->onDelete('cascade');
            $table->date('appointment_date');
            $table->time('opening_time');
            $table->time('closing_time');
            $table->unsignedSmallInteger('patient_capacity');
            $table->boolean('ot_status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_schedules');
    }
};
