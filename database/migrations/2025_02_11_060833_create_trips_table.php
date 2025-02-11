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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('origin_id')->constrained()->onDelete('cascade'); // ارتباط با مبدا
            $table->foreignId('destination_id')->constrained()->onDelete('cascade'); // ارتباط با مقصد
            $table->foreignId('terminal_id')->constrained()->onDelete('cascade'); // ارتباط با ترمینال
            $table->foreignId('transport_type_id')->constrained()->onDelete('cascade');
            $table->timestamp('date'); // تاریخ حرکت
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
