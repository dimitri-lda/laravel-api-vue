<?php

namespace Database\Seeders;

use App\Models\Enum\TennisRacketStringPattern;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\TennisRacketModel;
use App\Models\TennisRacketVariant;

class YonexDataSeeder extends Seeder
{
    public function run(): void
    {
        $brand = Brand::firstOrCreate(
            ['name' => 'Yonex'],
            [
                'logo_url' => 'https://www.yonex.com/static/version1749739423/frontend/Yonex/base/en_US/images/Yonex_Logo.svg',
                'country_code' => 'JP'
            ]
        );

        $modelMap = [
            'Ezone' => TennisRacketModel::create(['name' => 'Ezone', 'brand_id' => $brand->id, 'logo_url' => 'https://media.strefatenisa.com.pl/public/thumbnail/52/55/2d/1741250299/zz-08ez98_786-1_1280x1280.jpg']),
            'VCORE' => TennisRacketModel::create(['name' => 'VCORE', 'brand_id' => $brand->id, 'logo_url' => 'https://media.strefatenisa.com.pl/public/thumbnail/8e/62/28/1721063331/vcore98_4wmxwlkfgerg71_1280x1280.jpg']),
            'Percept' => TennisRacketModel::create(['name' => 'Percept', 'brand_id' => $brand->id, 'logo_url' => 'https://media.strefatenisa.com.pl/public/thumbnail/5b/d8/d1/1721055235/percept-game-olive-green-1a_1280x1280.jpg']),
        ];

        $variants = [
            ['EZ98-2024', 'Blue', 305, 98, 315, TennisRacketStringPattern::PATTERN_16x19, 64, 685, '23.5-24.5-19.5', 2024, 'Ezone'],
            ['EZ100-2024', 'Blue', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 65, 685, '23.8-26.5-22.5', 2024, 'Ezone'],
            ['VC95-2023', 'Red', 310, 95, 310, TennisRacketStringPattern::PATTERN_16x20, 66, 685, '21.5-22-21', 2023, 'VCORE'],
            ['VC98-2023', 'Red', 305, 98, 315, TennisRacketStringPattern::PATTERN_16x19, 66, 685, '22.5-23-21', 2023, 'VCORE'],
            ['VC100-2023', 'Red', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 66, 685, '24-25-22', 2023, 'VCORE'],
            ['VC95BG-2023', 'Beige', 310, 95, 310, TennisRacketStringPattern::PATTERN_16x20, 66, 685, '21.5-22-21', 2023, 'VCORE'],
            ['VC98BG-2023', 'Beige', 305, 98, 315, TennisRacketStringPattern::PATTERN_16x19, 66, 685, '22.5-23-21', 2023, 'VCORE'],
            ['VC100BG-2023', 'Beige', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 66, 685, '24-25-22', 2023, 'VCORE'],
            ['PC97H-2023', 'Olive Green', 330, 97, 310, TennisRacketStringPattern::PATTERN_16x19, 63, 685, '21-21-21', 2023, 'Percept'],
            ['PC100-2023', 'Olive Green', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 66, 685, '23-23-23', 2023, 'Percept'],
        ];

        foreach ($variants as $v) {
            TennisRacketVariant::create([
                'article_number' => $v[0],
                'color' => $v[1],
                'weight' => $v[2],
                'head_size' => $v[3],
                'balance' => $v[4],
                'string_pattern' => $v[5],
                'stiffness' => $v[6],
                'length' => $v[7],
                'frame_profile' => $v[8],
                'year' => $v[9],
                'tennis_racket_model_id' => $modelMap[$v[10]]->id
            ]);
        }
    }
}
