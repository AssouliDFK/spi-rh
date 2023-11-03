<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin youssef',
                'email' => 'admin@tersea.com',
                'role'=> 'admin',
                'status'=> 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Youssef',
                'email' => 'youssef@gmail.com',
                'role'=> 'admin',
                'status'=> 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Zineb',
                'email' => 'zineb@gmail.com',
                'role'=> 'admin',
                'status'=> 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'A.Employe1',
                'email' => 'a.employe@gmail.com',
                'role'=> 'employe',
                'status'=> 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'B.Employe2',
                'email' => 'B.employe@gmail.com',
                'role'=> 'employe',
                'status'=> 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'C.Employe3',
                'email' => 'a.employe3@gmail.com',
                'role'=> 'employe',
                'status'=> 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'D.Employe4',
                'email' => 'd.employe@gmail.com',
                'role' => 'employe',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'E.Employe5',
                'email' => 'e.employe@gmail.com',
                'role' => 'employe',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'F.Employe6',
                'email' => 'f.employe@gmail.com',
                'role' => 'employe',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'G.Employe7',
                'email' => 'g.employe@gmail.com',
                'role' => 'employe',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'H.Employe8',
                'email' => 'h.employe@gmail.com',
                'role' => 'employe',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'I.Employe9',
                'email' => 'i.employe@gmail.com',
                'role' => 'employe',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'J.Employe10',
                'email' => 'j.employe@gmail.com',
                'role' => 'employe',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
            
    ]);
    }
}
