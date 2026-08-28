<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lawyers', function (Blueprint $table) {

            $table->id();

            // Logged-in user
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // City
            $table->foreignId('city_id')
                  ->constrained('cities')
                  ->onDelete('cascade');

            // Service
            $table->foreignId('service_id')
                  ->constrained('services')
                  ->onDelete('cascade');

            // Professional Details
            $table->integer('experience')->default(0);
            $table->decimal('fee', 10, 2)->default(0.00);
            $table->text('bio')->nullable();

            // Profile
            $table->string('image')->nullable();
            $table->text('office_address')->nullable();
            $table->json('qualifications')->nullable();

            // Rating
            $table->decimal('rating', 3, 2)->default(5.00);
            $table->integer('total_reviews')->default(0);

            // Status
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lawyers');
    }
};