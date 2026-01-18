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
        Schema::table('attendee', function (Blueprint $table) {
            $table->integer('status')->default(1)->after('guest_of'); // Add the new column as an integer with default value 1
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendee', function (Blueprint $table) {
            $table->dropColumn('status'); // Drop the column if the migration is rolled back
        });
    }
};
