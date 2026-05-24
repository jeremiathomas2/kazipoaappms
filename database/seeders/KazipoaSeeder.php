<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Professional;
use App\Models\Client;
use App\Models\Booking;
use App\Models\Session;
use Illuminate\Support\Facades\Hash;

class KazipoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin Account
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@kazipoa.com',
            'password' => Hash::make('password'),
        ]);

        // Professionals
        $juma = Professional::create([
            'name' => 'Juma Hassan',
            'service' => 'House Cleaning',
            'region' => 'Mwanza',
            'rating' => 4.9,
            'jobs_count' => 247,
            'is_verified' => true,
            'avatar_color' => '#FF6B35',
            'status' => 'available',
        ]);

        $fatuma = Professional::create([
            'name' => 'Fatuma Ali',
            'service' => 'Electrician',
            'region' => 'Mwanza',
            'rating' => 4.8,
            'jobs_count' => 189,
            'is_verified' => true,
            'avatar_color' => '#6C63FF',
            'status' => 'in_session',
        ]);

        $david = Professional::create([
            'name' => 'David Mwangi',
            'service' => 'Plumber',
            'region' => 'Arusha',
            'rating' => 4.7,
            'jobs_count' => 312,
            'is_verified' => true,
            'avatar_color' => '#18C16E',
            'status' => 'available',
        ]);

        $ally = Professional::create([
            'name' => 'Ally Omar',
            'service' => 'Car Washer',
            'region' => 'Dar es Salaam',
            'rating' => 4.6,
            'jobs_count' => 98,
            'is_verified' => true,
            'avatar_color' => '#F5A623',
            'status' => 'starting_soon',
        ]);

        // Clients
        $amina = Client::create([
            'name' => 'Amina Salim',
            'contact' => '+255 712 345 678',
            'region' => 'Mwanza',
            'bookings_count' => 14,
            'last_active' => now(),
            'status' => 'active',
        ]);

        $baraka = Client::create([
            'name' => 'Baraka Mwenda',
            'contact' => 'baraka@email.com',
            'region' => 'Dar es Salaam',
            'bookings_count' => 7,
            'last_active' => now()->subMinutes(10),
            'status' => 'active',
        ]);

        $grace = Client::create([
            'name' => 'Grace Kimani',
            'contact' => '+255 789 111 222',
            'region' => 'Arusha',
            'bookings_count' => 3,
            'last_active' => now()->subHour(),
            'status' => 'active',
        ]);

        $mohamed = Client::create([
            'name' => 'Mohamed Said',
            'contact' => '+255 700 999 888',
            'region' => 'Mwanza',
            'bookings_count' => 22,
            'last_active' => now()->subDays(2),
            'status' => 'inactive',
        ]);

        // Bookings
        $b1 = Booking::create([
            'client_id' => $amina->id,
            'professional_id' => null,
            'service_type' => 'House Cleaning',
            'location' => 'Mwanza',
            'date' => '2026-06-01',
            'time' => '09:00:00',
            'type' => 'weekly',
            'status' => 'pending',
        ]);

        $b2 = Booking::create([
            'client_id' => $baraka->id,
            'professional_id' => $ally->id,
            'service_type' => 'Car Washing',
            'location' => 'Dar es Salaam',
            'date' => now()->toDateString(),
            'time' => '10:00:00',
            'type' => 'one-time',
            'status' => 'active',
        ]);

        $b3 = Booking::create([
            'client_id' => $grace->id,
            'professional_id' => $david->id,
            'service_type' => 'Plumbing Repair',
            'location' => 'Arusha',
            'date' => '2026-06-02',
            'time' => '14:00:00',
            'type' => 'one-time',
            'status' => 'accepted',
        ]);

        // Sessions
        Session::create([
            'booking_id' => $b2->id,
            'start_time' => now()->subMinutes(85),
            'duration' => '01:25:00',
            'status' => 'active',
        ]);
    }
}
