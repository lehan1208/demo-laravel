<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = [

            ['LastName' => 'Lê', 'FirstName' => 'Văn Lương', 'Email' => 'vanluong@gmail.com', 'phone' => '0123456789'],
            ['LastName' => 'Trần', 'FirstName' => 'Nhật Duật', 'Email' => 'nhatduat@gmail.com', 'phone' => '0987654321'],
        ];
        DB::table('employees')->insert($employees);
    }
}
