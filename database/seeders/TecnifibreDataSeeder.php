<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\TennisRacketModel;
use App\Models\TennisRacketVariant;
use App\Models\Enum\TennisRacketStringPattern;

class TecnifibreDataSeeder extends Seeder
{
    public function run(): void
    {
        $tecnifibre = Brand::firstOrCreate(
            ['name' => 'Tecnifibre'],
            [
                'logo_url' => 'https://www.tecnifibre.com/on/demandware.static/-/Sites-Tecnifibre-Library/default/dw38076408/images/header/logo.svg',
                'country_code' => 'FR'
            ]
        );

        $tecnifibreModelMap = [
            'T-Fight' => TennisRacketModel::firstOrCreate(['name' => 'T-Fight', 'brand_id' => $tecnifibre->id, 'logo_url' => 'https://media.strefatenisa.com.pl/public/thumbnail/3f/a2/c4/1741250262/14fi300s5_02_1280x1280.jpg']),
            'TF-X1' => TennisRacketModel::firstOrCreate(['name' => 'TF-X1', 'brand_id' => $tecnifibre->id, 'logo_url' => 'https://media.strefatenisa.com.pl/public/thumbnail/bf/44/82/1728158992/tfx1285v2_1280x1280.png']),
            'TF40' => TennisRacketModel::firstOrCreate(['name' => 'TF40', 'brand_id' => $tecnifibre->id, 'logo_url' => 'https://media.strefatenisa.com.pl/public/thumbnail/43/c8/d2/1721042446/tf4th-1_1280x1280.jpg']),
        ];

        $tecnifibreVariants = [
            ['TF300-2025', 'White', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 68, 685, '22.5', 2025, 'T-Fight'],
            ['TF300s-2024', 'White', 300, 98, 320, TennisRacketStringPattern::PATTERN_16x19, 68, 685, '22.5', 2025, 'T-Fight'],
            ['TF305s-2024', 'White', 305, 98, 315, TennisRacketStringPattern::PATTERN_18x20, 66, 685, '22.5', 2025, 'T-Fight'],
            ['TFX1-300-2024', 'White/Yellow', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 71, 685, '24-25-24', 2024, 'TF-X1'],
            ['TFX1-305-2024', 'White/Yellow', 305, 100, 315, TennisRacketStringPattern::PATTERN_16x19, 70, 685, '24-25-24', 2024, 'TF-X1'],
            ['TF40-305-2024', 'White', 305, 98, 320, TennisRacketStringPattern::PATTERN_18x20, 65, 685, '22.5', 2024, 'TF40'],
        ];

        foreach ($tecnifibreVariants as $v) {
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
                'tennis_racket_model_id' => $tecnifibreModelMap[$v[10]]->id
            ]);
        }
    }
}
