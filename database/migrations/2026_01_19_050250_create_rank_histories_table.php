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
        Schema::create('rank_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('status'); // PNS, PPPK, dll
            $table->string('rank_grade'); // Pangkat/Golongan
            $table->date('effective_date'); // TMT
            $table->string('promotion_type'); // Jenis KP
            $table->string('service_period')->nullable(); // Masa Kerja
            $table->string('decree_number')->nullable(); // No SK
            $table->date('decree_date')->nullable(); // Tgl SK
            $table->text('notes')->nullable(); // Keterangan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rank_histories');
    }
};
