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
        Schema::create('functional_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('jft_name'); // Nama JFT
            $table->string('agency_subminkal'); // Instansi Subminkal
            $table->string('level_grade'); // Jenjang/Gol
            $table->date('start_date'); // TMT Mulai
            $table->date('end_date')->nullable(); // TMT Selesai
            $table->string('decree_number')->nullable(); // No SK
            $table->date('decree_date')->nullable(); // Tanggal SK
            $table->decimal('credit_score', 8, 2)->nullable(); // Angka Kredit
            $table->string('status')->nullable(); // Status
            $table->text('notes')->nullable(); // Keterangan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('functional_positions');
    }
};
