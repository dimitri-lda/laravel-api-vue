<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\TennisRacketModel;
use App\Models\TennisRacketVariant;
use App\Models\Enum\TennisRacketStringPattern;

class HeadDataSeeder extends Seeder
{
    public function run(): void
    {
        $head = Brand::firstOrCreate(
            ['name' => 'Head'],
            [
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/8/88/HEAD.svg',
                'country_code' => 'AT'
            ]
        );

        $headModelMap = [
            'Prestige' => TennisRacketModel::firstOrCreate(['name' => 'Prestige', 'brand_id' => $head->id]),
            'Speed' => TennisRacketModel::firstOrCreate(['name' => 'Speed', 'brand_id' => $head->id]),
            'Gravity' => TennisRacketModel::firstOrCreate(['name' => 'Gravity', 'brand_id' => $head->id]),
            'Radical' => TennisRacketModel::firstOrCreate(['name' => 'Radical', 'brand_id' => $head->id]),
            'Extreme' => TennisRacketModel::firstOrCreate(['name' => 'Extreme', 'brand_id' => $head->id]),
            'Boom' => TennisRacketModel::firstOrCreate(['name' => 'Boom', 'brand_id' => $head->id]),
        ];

        $headVariants = [
            ['Prestige-Pro-2023', 'Bordeaux', 320, 98, 310, TennisRacketStringPattern::PATTERN_18x20, 62, 685, '20', 2023, 'Prestige'],
            ['Prestige-MP-2023', 'Bordeaux', 310, 99, 320, TennisRacketStringPattern::PATTERN_18x19, 63, 685, '20', 2023, 'Prestige'],
            ['Speed-Pro-2024', 'White/Black', 310, 100, 315, TennisRacketStringPattern::PATTERN_18x20, 64, 685, '23', 2024, 'Speed'],
            ['Speed-MP-2024', 'White/Black', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 64, 685, '23', 2024, 'Speed'],
            ['Gravity-Pro-2025', 'Teal/Black', 315, 100, 315, TennisRacketStringPattern::PATTERN_18x20, 63, 685, '22', 2025, 'Gravity'],
            ['Gravity-MP-2025', 'Teal/Black', 295, 100, 325, TennisRacketStringPattern::PATTERN_16x20, 63, 685, '22', 2025, 'Gravity'],
            ['Radical-Pro-2023', 'Orange/Grey', 315, 98, 315, TennisRacketStringPattern::PATTERN_20x19, 65, 685, '22', 2023, 'Radical'],
            ['Radical-MP-2023', 'Orange/Grey', 300, 98, 320, TennisRacketStringPattern::PATTERN_16x19, 65, 685, '22', 2023, 'Radical'],
            ['Extreme-Pro-2024', 'Yellow/Black', 315, 100, 315, TennisRacketStringPattern::PATTERN_16x19, 70, 685, '23', 2024, 'Extreme'],
            ['Extreme-MP-2024', 'Yellow/Black', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 70, 685, '23', 2024, 'Extreme'],
            ['Boom-Pro-2024', 'Black/Blue', 310, 100, 310, TennisRacketStringPattern::PATTERN_16x19, 66, 685, '24', 2024, 'Boom'],
            ['Boom-MP-2024', 'Black/Blue', 295, 100, 315, TennisRacketStringPattern::PATTERN_16x19, 66, 685, '24', 2024, 'Boom'],
        ];

        foreach ($headVariants as $v) {
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
                'tennis_racket_model_id' => $headModelMap[$v[10]]->id
            ]);
        }
    }
}
