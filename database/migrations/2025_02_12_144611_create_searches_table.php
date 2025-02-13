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
        Schema::create('searches', function (Blueprint $table) {
            $table->id();
            $table->string('origin_city_code')->nullable();
            $table->string('origin_terminal_code')->nullable();
            $table->string('origin_name')->nullable();
            $table->string('destination_city_code')->nullable();
            $table->string('destination_terminal_code')->nullable();
            $table->string('destination_name')->nullable();
            $table->date('date')->nullable();
            $table->foreignId('transport_type_id')->nullable()->constrained('transport_types')->onDelete('cascade');

            $table->foreignId('trip_id')->nullable()->constrained('trips')->onDelete('cascade');
            $table->integer('seat_count')->nullable();  // تعداد صندلی
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('searches');
    }
};
