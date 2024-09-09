<?php

namespace Database\Seeders;

use App\Models\Attendace;
use Database\Factories\AttendanceFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        AttendanceFactory::factory(10)->create();
    }
}
