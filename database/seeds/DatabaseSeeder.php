<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('system_roles')->insert([['role_name' => 'none'],['role_name' => 'basic_user'],['role_name' => 'ccfc_officer'],['role_name' => 'mis_admin']]);
        
        DB::table('ccfc_category')->insert([['category_name' => 'parking', 'status' => 1],['category_name' => 'swimming', 'status' => 1], ['category_name' => 'gym', 'status' => 1]]);

        DB::table('vehicle_make')->insert([
            ['make' => 'Abarth'],
            ['make' => 'Alfa Romeo'],
            ['make' => 'Aston Martin'],
            ['make' => 'Audi'],
            ['make' => 'BAIC'],
            ['make' => 'Bentley'],
            ['make' => 'BMW'],
            ['make' => 'BYD'],
            ['make' => 'Chery'],
            ['make' => 'Chevrolet'],
            ['make' => 'Chrysler'],
            ['make' => 'Dodge'],
            ['make' => 'FAW'],
            ['make' => 'Ferrari'],
            ['make' => 'Ford'],
            ['make' => 'Foton'],
            ['make' => 'GAC'],
            ['make' => 'GAZ'],
            ['make' => 'Great Wall'],
            ['make' => 'Haima'],
            ['make' => 'Honda'],
            ['make' => 'Hyundai'],
            ['make' => 'Isuzu'],
            ['make' => 'JAC'],
            ['make' => 'Jaguar'],
            ['make' => 'Jeep'],
            ['make' => 'JMC'],
            ['make' => 'Kia'],
            ['make' => 'King Long'],
            ['make' => 'Lamborghini'],
            ['make' => 'Land Rover'],
            ['make' => 'Lexus'],
            ['make' => 'Lotus'],
            ['make' => 'Mahindra'],
            ['make' => 'Maserati'],
            ['make' => 'Maxus'],
            ['make' => 'Mazda'],
            ['make' => 'Mercedes Benz'],
            ['make' => 'MG'],
            ['make' => 'MINI'],
            ['make' => 'Mitsubishi'],
            ['make' => 'Morgan'],
            ['make' => 'Nissan'],
            ['make' => 'Peugeot'],
            ['make' => 'Porshe'],
            ['make' => 'Rolls-Royce'],
            ['make' => 'SsangYong'],
            ['make' => 'Subaru'],
            ['make' => 'Suzuki'],
            ['make' => 'Tata'],
            ['make' => 'Toyota'],
            ['make' => 'Volkswagen'],
            ['make' => 'Volvo']
        ]);
    }
}
