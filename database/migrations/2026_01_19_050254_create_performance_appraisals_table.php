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
        Schema::create('performance_appraisals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->year('year'); // Tahun
            $table->integer('loyalty_score'); // Kesetiaan
            $table->integer('achievement_score'); // Prestasi Kerja
            $table->integer('responsibility_score'); // Tanggung Jawab
            $table->integer('obedience_score'); // Ketaatan
            $table->integer('honesty_score'); // Kejujuran
            $table->integer('cooperation_score'); // Kerjasama
            $table->integer('initiative_score'); // Prakarsa
            $table->integer('leadership_score'); // Kepemimpinan
            $table->integer('total_score'); // Total Nilai
            $table->string('rating'); // Sebutan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_appraisals');
    }
};
