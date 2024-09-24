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
        Schema::table('attendances', function (Blueprint $table) {
            //
            $table->tinyInteger('attendance_pass_status')->default(0)->after('qr_code')->nullable();
            $table->date('date_issued')->nullable()->after('attendance_pass_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            //
            $table->dropColumn('attendance_pass_status');
            $table->dropColumn('date_issued');
        });
    }
};
