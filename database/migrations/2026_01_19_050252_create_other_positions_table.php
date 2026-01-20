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
        Schema::create('other_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('position_name'); // Nama Jabatan
            $table->string('agency'); // Instansi
            $table->date('start_date'); // TMT Mulai
            $table->date('end_date')->nullable(); // TMT Selesai
            $table->string('decree_number')->nullable(); // No SK
            $table->date('decree_date')->nullable(); // Tanggal SK
            $table->text('notes')->nullable(); // Keterangan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_positions');
    }
};
