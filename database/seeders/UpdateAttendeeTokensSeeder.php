<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendee;

class UpdateAttendeeTokensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update tokens for all existing attendees based on id
        Attendee::all()->each(function ($attendee) {
            $token = md5($attendee->id);
            $attendee->update(['token' => $token]);
        });
    }
}
