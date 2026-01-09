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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama_cetak_tanpa_gelar')->nullable()->after('name');
            $table->string('nama_cetak_dengan_gelar')->nullable()->after('nama_cetak_tanpa_gelar');

            $table->string('birth_place')->nullable()->after('gender');
            $table->date('birth_date')->nullable()->after('birth_place');

            $table->foreignId('pangkat_golongan_id')->nullable()->constrained('ranks')->nullOnDelete()->after('job_position_id');
            $table->date('tmt_golongan')->nullable()->after('pangkat_golongan_id');

            $table->foreignId('jenis_asn_id')->nullable()->constrained('asn_types')->nullOnDelete()->after('tmt_golongan');
            $table->foreignId('jenis_jab_id')->nullable()->constrained('job_types')->nullOnDelete()->after('jenis_asn_id');

            // structural position uses job_positions table
            $table->foreignId('struktural_position_id')->nullable()->constrained('job_positions')->nullOnDelete()->after('jenis_jab_id');

            $table->foreignId('employment_status_id')->nullable()->constrained('employment_statuses')->nullOnDelete()->after('struktural_position_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
