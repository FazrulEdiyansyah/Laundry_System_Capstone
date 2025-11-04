<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DummyCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Dummy Customer',
            'email' => 'dummy@customer.com',
            'password' => bcrypt('password123'),
            'role' => 'customer',
            'whatsapp' => '08123456789',
            'address' => 'Jl. Dummy No. 123'
        ]);
    }
}
