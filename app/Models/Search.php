<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin_city_code',  // کد شهر مبدا
        'origin_terminal_code',  // کد ترمینال مبدا
        'origin_name',  // نام مبدا
        'destination_city_code',  // کد شهر مقصد
        'destination_terminal_code',  // کد ترمینال مقصد
        'destination_name',  // نام مقصد
        'date',  // تاریخ سفر
        'transport_type_id',  // شناسه نوع حمل‌ونقل
        'trip_id',  // شناسه سفر
        'seat_count',  // تعداد صندلی
    ];



}
