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
        Schema::table('user_coupons', function (Blueprint $table) {
            // Check if 'user_id' column exists
            if (Schema::hasColumn('user_coupons', 'user_id')) {
                // Drop the foreign key constraint if it exists
                $foreignKeys = \DB::select('SELECT name FROM sqlite_master WHERE type = "table" AND tbl_name = "user_coupons" AND sql LIKE "%FOREIGN KEY%"');
                if (!empty($foreignKeys)) {
                    $table->dropForeign(['user_id']);
                }
            }
        });

        Schema::table('user_coupons', function (Blueprint $table) {
            // Drop the column if it exists
            if (Schema::hasColumn('user_coupons', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });

        Schema::table('user_coupons', function (Blueprint $table) {
            // Recreate the column as nullable
            $table->unsignedBigInteger('user_id')->nullable()->after('id');

            // Add the new foreign key constraint
            $table->foreign('user_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_coupons', function (Blueprint $table) {
            // Check if 'user_id' column exists
            if (Schema::hasColumn('user_coupons', 'user_id')) {
                // Drop the foreign key constraint if it exists
                $foreignKeys = \DB::select('SELECT name FROM sqlite_master WHERE type = "table" AND tbl_name = "user_coupons" AND sql LIKE "%FOREIGN KEY%"');
                if (!empty($foreignKeys)) {
                    $table->dropForeign(['user_id']);
                }
            }
        });

        Schema::table('user_coupons', function (Blueprint $table) {
            // Drop the column if it exists
            if (Schema::hasColumn('user_coupons', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });

        Schema::table('user_coupons', function (Blueprint $table) {
            // Recreate the column as nullable
            $table->unsignedBigInteger('user_id')->nullable()->after('id');

            // Add the new foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
