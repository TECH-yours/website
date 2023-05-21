<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\allgericlist;


class AllgericSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'mid' => 1,
                'aid' => 1,
            ],
            [
                'mid' => 5,
                'aid' => 1,
            ],
            [
                'mid' => 6,
                'aid' => 1,
            ],
            [
                'mid' => 11,
                'aid' => 2,
            ]
        ];        

        allgericlist::insert($data);
    }
}
