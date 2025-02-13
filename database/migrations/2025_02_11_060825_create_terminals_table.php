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
        Schema::create('terminals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('origin_id')->nullable()->constrained('origins')->onDelete('cascade'); // مبدا
            $table->foreignId('destination_id')->nullable()->constrained('destinations')->onDelete('cascade'); // مقصد
            $table->string('name'); // نام ترمینال
            $table->string('terminal_code')->unique(); // کد ترمینال
            $table->enum('type', ['bus', 'airport', 'train']); // نوع ترمینال (اتوبوس، فرودگاه، قطار و ... )
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terminals');
    }
};
