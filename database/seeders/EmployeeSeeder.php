<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Company;

use DB;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
       // Get the company IDs for assigning employees
$companyAId = DB::table('companies')->where('name', 'Company A')->value('id');
$companyBId = DB::table('companies')->where('name', 'Company B')->value('id');

DB::table('employees')->insert([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => bcrypt('password'),
    'belongs_to_company' => $companyAId,
]);

DB::table('employees')->insert([
    [
        'name' => 'Smith',
        'email' => 'jane@example.com',
        'password' => bcrypt('password'),
        'belongs_to_company' => $companyBId,
    ],
    [
        'name' => 'Johnson',
        'email' => 'alice@example.com',
        'password' => bcrypt('password'),
        'belongs_to_company' => $companyAId,
    ],
]);


    }
}
