<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('title', 100)->nullable();
            $table->text('description')->nullable();
            $table->integer('discount_percent')->nullable();
            $table->boolean('is_active')->default(true);
            $table->date('expired_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
