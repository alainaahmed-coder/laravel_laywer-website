<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lawyer_schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lawyer_id')
                ->constrained('lawyers')
                ->cascadeOnDelete();

            $table->string('day');

            $table->time('start_time');

            $table->time('end_time');

            $table->integer('slot_duration')->default(30);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lawyer_schedules');
    }
};