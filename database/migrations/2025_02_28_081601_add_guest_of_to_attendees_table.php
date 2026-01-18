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
            $table->integer('guest_of')->nullable()->after('type'); // Add the new column as an integer
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendee', function (Blueprint $table) {
            $table->dropColumn('guest_of'); // Drop the column if the migration is rolled back
        });
    }
};
