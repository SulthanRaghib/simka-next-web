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
            $table->string('nip')->nullable()->unique()->index()->after('email');
            $table->foreignId('work_unit_id')->nullable()->constrained('work_units')->nullOnDelete()->after('nip');
            $table->foreignId('job_position_id')->nullable()->constrained('job_positions')->nullOnDelete()->after('work_unit_id');
            $table->string('phone_number')->nullable()->after('password');
            $table->text('address')->nullable()->after('phone_number');
            $table->enum('gender', ['L', 'P'])->nullable()->after('address');
            $table->boolean('is_active')->default(true)->after('gender');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['work_unit_id']);
            $table->dropForeign(['job_position_id']);
            $table->dropColumn([
                'nip',
                'work_unit_id',
                'job_position_id',
                'phone_number',
                'address',
                'gender',
                'is_active'
            ]);
        });
    }
};
