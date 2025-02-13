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
        // Migration for trips table
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('origin_id')->constrained()->onDelete('cascade');  // مبدا
            $table->foreignId('destination_id')->constrained()->onDelete('cascade');  // مقصد
            $table->foreignId('transport_type_id')->constrained()->onDelete('cascade');  // نوع حمل‌ونقل

            // اضافه کردن ستون‌های جداگانه برای ترمینال مبدا و مقصد
            $table->string('origin_terminalable_type');  // نوع ترمینال مبدا
            $table->foreignId('origin_terminalable_id');  // آی‌دی ترمینال مبدا

            $table->string('destination_terminalable_type');  // نوع ترمینال مقصد
            $table->foreignId('destination_terminalable_id');  // آی‌دی ترمینال مقصد

            $table->timestamp('date');  // تاریخ سفر
            $table->timestamps();

            // اضافه کردن ایندکس‌های کوتاه‌تر به صورت دستی
            $table->index(['origin_terminalable_type', 'origin_terminalable_id'], 'origin_term_idx');
            $table->index(['destination_terminalable_type', 'destination_terminalable_id'], 'dest_term_idx');
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
