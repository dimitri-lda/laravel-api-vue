<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\TennisRacketModel;
use App\Models\TennisRacketVariant;
use App\Models\Enum\TennisRacketStringPattern;

class WilsonDataSeeder extends Seeder
{
    public function run(): void
    {
        $wilson = Brand::firstOrCreate(
            ['name' => 'Wilson'],
            [
                'logo_url' => 'https://www.wilson.com/icons/logo-black.svg',
                'country_code' => 'US'
            ]
        );

        $wilsonModelMap = [
            'Clash' => TennisRacketModel::firstOrCreate(['name' => 'Clash', 'brand_id' => $wilson->id]),
            'Blade' => TennisRacketModel::firstOrCreate(['name' => 'Blade', 'brand_id' => $wilson->id]),
            'Ultra' => TennisRacketModel::firstOrCreate(['name' => 'Ultra', 'brand_id' => $wilson->id]),
            'Shift' => TennisRacketModel::firstOrCreate(['name' => 'Shift', 'brand_id' => $wilson->id]),
            'Pro Staff' => TennisRacketModel::firstOrCreate(['name' => 'Pro Staff', 'brand_id' => $wilson->id]),
            'RF 01' => TennisRacketModel::firstOrCreate(['name' => 'RF 01', 'brand_id' => $wilson->id]),
        ];

        $wilsonVariants = [
            ['Clash-100-16x19', 'Red/Black', 300, 100, 310, TennisRacketStringPattern::PATTERN_16x19, 55, 685, '24', 2024, 'Clash'],
            ['Clash-98-16x19', 'Red/Black', 310, 98, 305, TennisRacketStringPattern::PATTERN_16x19, 55, 685, '24', 2024, 'Clash'],
            ['Blade-100-16x19', 'Green/Black', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 61, 685, '21', 2024, 'Blade'],
            ['Blade-98-16x19', 'Green/Black', 305, 98, 320, TennisRacketStringPattern::PATTERN_16x19, 61, 685, '21', 2024, 'Blade'],
            ['Blade-98-18x20', 'Green/Black', 305, 98, 320, TennisRacketStringPattern::PATTERN_18x20, 61, 685, '21', 2024, 'Blade'],
            ['Ultra-100-16x19', 'Blue', 300, 100, 315, TennisRacketStringPattern::PATTERN_16x19, 70, 685, '23', 2024, 'Ultra'],
            ['Ultra-98-16x19', 'Blue', 305, 98, 315, TennisRacketStringPattern::PATTERN_16x19, 70, 685, '23', 2024, 'Ultra'],
            ['Shift-99-16x19', 'White/Coral', 300, 100, 315, TennisRacketStringPattern::PATTERN_16x19, 68, 685, '24', 2024, 'Shift'],
            ['Shift-99Pro-18x20', 'White/Coral', 315, 99, 323, TennisRacketStringPattern::PATTERN_18x20, 68, 685, '24', 2024, 'Shift'],
            ['ProStaff-97-16x19', 'Black/Red', 315, 97, 310, TennisRacketStringPattern::PATTERN_16x19, 65, 685, '21', 2024, 'Pro Staff'],
            ['ProStaff-97-18x20', 'Black/Red', 315, 97, 310, TennisRacketStringPattern::PATTERN_18x20, 65, 685, '21', 2024, 'Pro Staff'],
            ['RF01-98-16x19', 'Black/White', 300, 98, 325, TennisRacketStringPattern::PATTERN_16x19, 64, 685, '24', 2024, 'RF 01'],
            ['RF01Pro-98-16x19', 'Black/White', 320, 98, 315, TennisRacketStringPattern::PATTERN_16x19, 67, 685, '24', 2024, 'RF 01'],
        ];

        foreach ($wilsonVariants as $v) {
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
                'tennis_racket_model_id' => $wilsonModelMap[$v[10]]->id
            ]);
        }
    }
}
