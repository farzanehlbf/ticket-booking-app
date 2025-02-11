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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade'); // ارتباط با رزرو
            $table->foreignId('passenger_id')->constrained()->onDelete('cascade'); // ارتباط با مسافر
            $table->string('ticket_number')->unique(); // شماره بلیط
            $table->string('identity_id'); // کد ملی مسافر
            $table->foreignId('trip_id')->constrained()->onDelete('cascade'); // ارتباط با سفر
            $table->enum('status', ['active', 'cancelled'])->default('active');
            $table->timestamp('cancellation_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
