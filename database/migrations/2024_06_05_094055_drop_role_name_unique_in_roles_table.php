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
        Schema::table('roles', function (Blueprint $table) {
            // Check if the 'name' column exists
            if (Schema::hasColumn('roles', 'name')) {
                try {
                    // Attempt to drop the unique constraint
                    $table->dropUnique('roles_name_unique');
                } catch (\Exception $e) {
                    // If the constraint doesn't exist, just continue
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            // Add back the unique constraint if needed
            $table->unique('name');
        });
    }
};
