<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyAId = DB::table('companies')->where('name', 'Company A')->value('id');
        DB::table('users')->insert([
            [
                'name' => 'Admin youssef',
                'email' => 'admin@tersea.com',
                'role' => 'admin',
                'status' => 'active',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Youssef',
                'email' => 'youssef@gmail.com',
                'role' => 'admin',
                'status' => 'pending',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Zineb',
                'email' => 'zineb@gmail.com',
                'role' => 'admin',
                'status' => 'inactive',
                'password' => bcrypt('password'),
            ],

        ]);
        DB::table('users')->insert([
            [
                'name' => 'A.Employe1',
                'email' => 'a.employe@gmail.com',
                'role' => 'employe',
                'status' => 'active',
                'password' => bcrypt('password'),
                'company_id' => $companyAId,
            ],
            [
                'name' => 'B.Employe2',
                'email' => 'B.employe@gmail.com',
                'role' => 'employe',
                'status' => 'inactive',
                'password' => bcrypt('password'),
                'company_id' => 1,

            ],
            [
                'name' => 'C.Employe3',
                'email' => 'a.employe3@gmail.com',
                'role' => 'employe',
                'status' => 'active',
                'password' => bcrypt('password'),
                'company_id' => $companyAId,

            ],
            [
                'name' => 'D.Employe4',
                'email' => 'd.employe@gmail.com',
                'role' => 'employe',
                'status' => 'pending',
                'password' => bcrypt('password'),
                'company_id' => $companyAId,

            ],

        ]);
    }
}
