<?php

namespace Database\Seeders;

use App\Models\AccessLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccessLog::factory()->count(20)->create();
    }
}
