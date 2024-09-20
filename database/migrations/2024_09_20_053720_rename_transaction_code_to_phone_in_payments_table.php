<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            //
            $table->string('phone')->nullable()->unique()->after('transaction_code');
        });

        // Migrate data from `transaction_code` to `phone_number`
        DB::statement('UPDATE payments SET phone = transaction_code');

        Schema::table('payments', function (Blueprint $table) {
            // Drop the old column
            $table->dropColumn('transaction_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            //
            $table->string('transaction_code')->nullable()->after('phone')->unique();
        });

        // Migrate data back from `phone_number` to `transaction_code`
        DB::statement('UPDATE payments SET transaction_code = phone');

        Schema::table('payments', function (Blueprint $table) {
            // Drop the new column
            $table->dropColumn('phone');
        });
    }
};
