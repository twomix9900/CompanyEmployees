<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [[
            'name' => 'Test Admin',
            'email' => '​admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ],
        [
            'name' => 'Test Employee',
            'email' => 'employee@employee.com',
            'password' => bcrypt('password'),
            'role' => 'employee'
        ]];
        User::insert($users);
    

        DB::table('companies')->insert([
            'name' => 'Test Company',
            'website' => 'www.test.com',
            'logo' => 'PH'
        ]);

        DB::table('employees')->insert([
            'first_name' => 'Test',
            'last_name' => 'Employee',
            'email' => 'test@test.com',
            'company' => '1'
        ]);
    }
}
