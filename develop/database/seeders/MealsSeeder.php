<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Meals;

class MealsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'rid' => 1,
                'name' => '炙烤鯖魚餐盒',
                'price' => 140,
                'category' => 2,
            ],
            [
                'rid' => 1,
                'name' => '照燒雞腿餐盒',
                'price' => 130,
                'category' => 2,
            ],
            [
                'rid' => 1,
                'name' => '蔥鹽雞胸餐盒',
                'price' => 130,
                'category' => 1,
            ],
            [
                'rid' => 1,
                'name' => '黑胡椒雞胸餐盒',
                'price' => 130,
                'category' => 1,
            ],
            [
                'rid' => 1,
                'name' => '柚香鮭魚餐盒',
                'price' => 140,
                'category' => 2,
            ],
            [
                'rid' => 1,
                'name' => '味噌鮭魚餐盒',
                'price' => 140,
                'category' => 2,
            ],
            [
                'rid' => 1,
                'name' => '壽喜牛肉餐盒',
                'price' => 140,
                'category' => 2,
            ],
            [
                'rid' => 1,
                'name' => '辛味薑燒豬餐盒',
                'price' => 140,
                'category' => 2,
            ],
            [
                'rid' => 1,
                'name' => '打拋豬肉餐盒',
                'price' => 140,
                'category' => 1,
            ],
            [
                'rid' => 1,
                'name' => '咖哩雞腿套餐',
                'price' => 130,
                'category' => 2,
            ],
            [
                'rid' => 1,
                'name' => '和風胡麻奶油雞胸套餐',
                'price' => 130,
                'category' => 2,
            ],
            [
                'rid' => 1,
                'name' => '馬祖紅糟豬排套餐',
                'price' => 140,
                'category' => 1,
            ],
        ];
        foreach ($data as $key => $value) {
            $data[$key]['created_at'] = now();
            $data[$key]['updated_at'] = now();
        }

        Meals::insert($data);
    }
}
