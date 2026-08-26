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
        Schema::create('lawyers', function (Blueprint $table) {
            $table->id();

            // Optional User Link (agar lawyer login system active ho)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            // Card & Header Main Details
            $table->string('name');                          // e.g. Adv. Kamran Sheikh
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();              // Profile photo path
            $table->boolean('is_verified')->default(false);  // Yellow/Gold checkmark badge

            // Professional Details (Cards & Filters)
            $table->string('specialization');                 // e.g. Criminal Law
            $table->integer('experience')->default(0);        // Experience in Years (e.g. 21)
            $table->decimal('fee', 10, 2)->default(0.00);     // Consultation Fee (e.g. 12000.00)

            // Location
            $table->string('city');                           // e.g. Islamabad (Direct String/Foreign key)
            $table->text('office_address')->nullable();       // Full office address for single page

            // Single Profile Page Extra Details
            $table->text('bio')->nullable();                  // Short About section
            $table->json('qualifications')->nullable();       // Multiple qualifications array/list (e.g. ["LL.B", "LL.M"])

            // Ratings & Reviews Counter (For Cards & Profile summary)
            $table->decimal('rating', 3, 2)->default(5.00);   // Average rating e.g. 5.0
            $table->integer('total_reviews')->default(0);     // Total reviews count e.g. 302

            // System / Admin Status
            $table->boolean('is_approved')->default(false);   // Admin approval status
            $table->boolean('is_active')->default(true);      // Active profile status

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lawyers');
    }
};
