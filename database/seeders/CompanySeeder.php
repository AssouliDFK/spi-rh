<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
        DB::table('companies')->insert([
            [
                'name' => 'Company A',
            ],
            [
                'name' => 'Company B',
            ],
            [
                'name' => 'Company CBC',
            ],
            [
                'name' => 'Company DCBC',
            ],
            [
                'name' => 'Company CBCE',
            ],
            [
                'name' => 'Company FCBC',
            ],
        ]);
    }
}
