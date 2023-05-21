<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\RefAllgeric;

class RefAllgericSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [ 'name' => '魚類(鮭魚、鯖魚、鱈魚、圓鱈、扁鱈)' ],
            [ 'name' => '牛奶、羊奶及其製品' ]
        ];        

        RefAllgeric::insert($data);
    }
}
