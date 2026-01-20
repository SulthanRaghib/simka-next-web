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
        Schema::create('salary_increases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('decree_number'); // Nomor SK
            $table->date('decree_date'); // Tgl SK
            $table->string('grade'); // Gol.
            $table->string('service_period')->nullable(); // Masa Kerja
            $table->decimal('salary_amount', 15, 2); // Besaran Gaji
            $table->date('effective_date'); // TMT Gaji
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_increases');
    }
};
