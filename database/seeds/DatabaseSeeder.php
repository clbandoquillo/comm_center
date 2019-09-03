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
    }
}
