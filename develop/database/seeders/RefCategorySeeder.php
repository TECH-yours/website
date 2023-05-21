<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RefCategory; 

class RefCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [ 'name' => '中式' ],
            [ 'name' => '日式' ]
        ];        

        RefCategory::insert($data);
    }
}
