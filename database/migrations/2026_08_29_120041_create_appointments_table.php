<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lawyer_id')
                ->constrained('lawyers')
                ->cascadeOnDelete();

            $table->foreignId('customer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->date('appointment_date');

            $table->time('appointment_time');

            $table->string('meeting_type');

            $table->text('case_summary')->nullable();

            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'cancelled',
                'completed'
            ])->default('pending');

            $table->timestamps();

            // Same lawyer ka same date/time dobara book nahi ho sakta
            $table->unique([
                'lawyer_id',
                'appointment_date',
                'appointment_time'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};