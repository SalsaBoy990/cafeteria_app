<?php

namespace Database\Seeders;

use App\Models\Allocation;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Allocations every month
        $startDate = DateTime::createFromFormat('Y-m-d H:i:s', '2024-01-01 00:00:00');
        for ($i = 0; $i < 12; $i++) {
            Allocation::factory()->create([
                'date' => $startDate->format('Y-m-d'),
            ]);
            $startDate->modify('+1 month');
        }
    }
}
