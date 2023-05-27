<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use Illuminate\Support\Str;
 
class restaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => '真飽餐盒',
                'lat' => '25.04297906340481',
                'lng' => '121.55344413809075',
                'area' => '106',
                'address' => '台灣台北市大安區延吉街70巷6弄3號',
                'google_map_url' => 'https://goo.gl/maps/V66n9Sns4H1J1my37?coh=178573&entry=tt',
            ],
            [
                'name' => '純淨時代 Pure Era',
                'lat' => '25.048101412137463',
                'lng' => '121.55701515123988',
                'area' => '105',
                'address' => '台灣台北市松山區光復南路6巷31號',
                'google_map_url' => 'https://goo.gl/maps/6Y1Z9Z1Z1Z1Z1Z1Z1',
            ],
            [
                'name' => '肌肉海灘',
                'lat' => '25.020850701637205',
                'lng' => '121.55752299303893',
                'area' => '110',
                'address' => '台灣台北市信義區和平東路三段391巷8弄24號',
                'google_map_url' => 'https://goo.gl/maps/6Y1Z9Z1Z1Z1Z1Z1Z1',
            ],
            [
                'name' => '健康水煮餐盒 Dr.salt',
                'lat' => '25.05389390892433',
                'lng' => '121.53379852694073',
                'area' => '104',
                'address' => '台北市松山區光復北路60巷19號之11',
                'google_map_url' => 'https://goo.gl/maps/6Y1Z9Z1Z1Z1Z1Z1Z1',
            ],
            [
                'name' => 'Miss Energy 能量小姐 台北錦州 直營門市',
                'lat' => '25.060499008809558',
                'lng' => '121.53567322681667',
                'area' => '104',
                'address' => '台灣台北市中山區錦州街290號',
                'google_map_url' => 'https://goo.gl/maps/6Y1Z9Z1Z1Z1Z1Z1Z1',
            ],
            [
                'name' => '拾福青果 中正店',
                'lat' => '25.05914193055675',
                'lng' => '121.52350029739269',
                'area' => '104',
                'address' => '台灣台北市中山區長春路3巷9號',
                'google_map_url' => 'https://goo.gl/maps/6Y1Z9Z1Z1Z1Z1Z1Z1',
            ],
            [
                'name' => '強尼兄弟Johnny Bro健康廚房 台北旗艦店',
                'lat' => '25.05416573122476',
                'lng' => '121.53414330197133',
                'area' => '105',
                'address' => '台灣台北市中山區伊通街48號',
                'google_map_url' => 'https://goo.gl/maps/6Y1Z9Z1Z1Z1Z1Z1Z1',
            ],
        ];
        foreach ($data as $key => $value) {
            $data[$key]['created_at'] = now();
            $data[$key]['updated_at'] = now();
        }
        Restaurant::insert($data);
    }
}
