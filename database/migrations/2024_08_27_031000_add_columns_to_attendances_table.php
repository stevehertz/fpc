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
            $table->tinyInteger('confirmation_status')->default(0)->nullable()->after('user_type');
            $table->text('qr_code')->nullable()->after('confirmation_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            //
            $table->dropColumn('confirmation_status');
            $table->dropColumn('qr_code');
        });
    }
};
