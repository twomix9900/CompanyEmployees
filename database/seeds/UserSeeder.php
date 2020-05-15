<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Companies;
use App\Employees;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $users = [
        [
            'name' => 'Admin',
            'email' => '​admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ],
        [
            'name' => 'User1',
            'email' => 'employee@employee.com',
            'password' => bcrypt('password'),
            'role' => 'employee'
        ],
        [
            'name' => 'User2',
            'email' => 'employee2@employee2.com',
            'password' => bcrypt('password'),
            'role' => 'employee'
        ],
        ];
        User::insert($users);
    

        $companies = [
        [
            'name' => 'Test Company 1',
            'website' => 'www.test1.com',
            'logo' => 'PH'
        ],
        [
            'name' => 'Test Company 2',
            'website' => 'www.test2.com',
            'logo' => 'PH'
        ]
        ];
        Companies::insert($companies);

        $employees = [
            [
                'first_name' => 'Employee',
                'last_name' => '1',
                'email' => 'employee@employee.com',
                'company' => '1'
            ],
            [
                'first_name' => 'Employee22',
                'last_name' => '1',
                'email' => 'employee22@employee22.com',
                'company' => '2'
            ],
            [
                'first_name' => 'Employee11',
                'last_name' => '1',
                'email' => 'employee11@employee11.com',
                'company' => '1'
            ],
            [
                'first_name' => 'Employee',
                'last_name' => '2',
                'email' => 'employee2@employee2.com',
                'company' => '2'
            ]
            ];
        Employees::insert($employees);

        for ($i = 0; $i < 1000; $i++) {
            $faker_company = $faker->company;
            App\Companies::create([
                'name' => $faker_company,
                // 'email' => $faker->unique()->email,
                'website' => 'www.' . str_replace(',', '', str_replace(' ', '', $faker_company)) . '.com',
                'logo' => ''
            ]);
        }

        for ($i = 0; $i < 1000; $i++) {
            $faker_first_name = $faker->firstName;
            $faker_last_name = $faker->lastName;
            $faker_full_name = $faker_first_name . $faker_last_name;
            $faker_email = $faker_full_name . '@' . $faker->domainName;
            App\Employees::create([
                'first_name' => $faker_first_name,
                'last_name' => $faker_last_name,
                'email' => $faker_email,
                'company' => $faker->numberBetween(1, 1000)
            ]);

            App\User::create([
                'name' => $faker_full_name,
                'email' => $faker_email,
                'password' => bcrypt('password'),
                'role' => 'employee'
            ]);
        }
    }
}
