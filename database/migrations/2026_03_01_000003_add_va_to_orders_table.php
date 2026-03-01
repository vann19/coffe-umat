<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('bank')->nullable()->after('payment_method');
            $table->string('va_number')->nullable()->after('bank');
            $table->string('biller_code')->nullable()->after('va_number');  // untuk Mandiri echannel
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['bank', 'va_number', 'biller_code']);
        });
    }
};
