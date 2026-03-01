<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Kolom referensi ke tabel 'menus' (integer ID) — berbeda dari menu_item_id (UUID ke menu_items)
            $table->unsignedBigInteger('menu_id')->nullable()->after('menu_item_id');
            $table->string('item_name', 255)->nullable()->after('menu_id');
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['menu_id', 'item_name']);
        });
    }
};
