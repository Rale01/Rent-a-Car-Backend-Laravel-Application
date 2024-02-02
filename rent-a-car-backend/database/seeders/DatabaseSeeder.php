<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $UserSeeder = new UserSeeder;
        $UserSeeder->run();

        $CarTypeSeeder = new CarTypeSeeder;
        $CarTypeSeeder->run();

        $CarSeeder = new CarSeeder;
        $CarSeeder->run();

        $RentalAgentSeeder = new RentalAgentSeeder;
        $RentalAgentSeeder->run();

        $TransactionSeeder = new TransactionSeeder;
        $TransactionSeeder->run();
    }
}
