<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\TennisRacketModel;
use App\Models\TennisRacketVariant;
use App\Models\Enum\TennisRacketStringPattern;

class DunlopSolincoDataSeeder extends Seeder
{
    public function run(): void
    {
        $dunlop = Brand::firstOrCreate(
            ['name' => 'Dunlop'],
            [
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/13/Dunlop_brand_logo.svg',
                'country_code' => 'UK',
            ],
        );

        $dunlopModelMap = [
            'CX' => TennisRacketModel::firstOrCreate(['name' => 'CX', 'brand_id' => $dunlop->id, 'logo_url' => 'https://media.strefatenisa.com.pl/public/thumbnail/e9/52/75/1721055565/d200s-1_1280x1280.jpg']),
            'FX' => TennisRacketModel::firstOrCreate(['name' => 'FX', 'brand_id' => $dunlop->id, 'logo_url' => 'https://media.strefatenisa.com.pl/public/thumbnail/d8/6d/47/1721043677/dunlop-fx-500-tour-naciag-usluga-serwisowa-2_1280x1280.jpg']),
            'SX' => TennisRacketModel::firstOrCreate(['name' => 'SX', 'brand_id' => $dunlop->id, 'logo_url' => 'https://media.strefatenisa.com.pl/public/thumbnail/71/7a/a1/1746525065/10361525_28_DT25_SX%20300_1_1920x1920.jpg']),
        ];

        $dunlopVariants = [
            ['CX200-2024', 'Red/Black', 305, 98, 315, TennisRacketStringPattern::PATTERN_16x19, 65, 685, '21.5-21.5-21.5', 2024, 'CX'],
            ['CX400-2024', 'Red/Black', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 66, 685, '23-23-23', 2024, 'CX'],
            ['FX500-2024', 'Blue', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 71, 685, '23-26-23', 2024, 'FX'],
            ['FX500Tour-2024', 'Blue', 305, 98, 315, TennisRacketStringPattern::PATTERN_16x19, 70, 685, '21-23-22', 2024, 'FX'],
            ['SX300-2024', 'Yellow/Black', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 68, 685, '23-26-23', 2024, 'SX'],
            ['SX300Tour-2024', 'Yellow/Black', 305, 98, 315, TennisRacketStringPattern::PATTERN_16x19, 67, 685, '23-26-23', 2024, 'SX'],
        ];

        foreach ($dunlopVariants as $v) {
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
                'tennis_racket_model_id' => $dunlopModelMap[$v[10]]->id
            ]);
        }

        $solinco = Brand::firstOrCreate(
            ['name' => 'Solinco'],
            [
                'logo_url' => 'https://www.solincosports.com/wp-content/uploads/2021/02/SOL_WDMRK_PRFM_BK_RGB_XL.png',
                'country_code' => 'US',
            ],
        );

        $solincoModelMap = [
            'Whiteout' => TennisRacketModel::firstOrCreate(['name' => 'Whiteout', 'brand_id' => $solinco->id, 'logo_url' => 'https://media.strefatenisa.com.pl/public/thumbnail/4f/26/bb/1742840587/20241209_sol_racquet_whiteout-v2_305_3-4_bgr_trn_01-2-scaled_1280x1280.jpg']),
            'Blackout' => TennisRacketModel::firstOrCreate(['name' => 'Blackout', 'brand_id' => $solinco->id, 'logo_url' => 'https://media.strefatenisa.com.pl/public/thumbnail/74/a3/3b/1721080370/solinco_10plzg4uqvszpfb_1280x1280.jpg']),
        ];

        $solincoVariants = [
            ['Whiteout305-2025', 'White', 305, 98, 315, TennisRacketStringPattern::PATTERN_18x20, 64, 685, '21.7-21.7-21.7', 2025, 'Whiteout'],
            ['Whiteout300-2025', 'White', 300, 98, 320, TennisRacketStringPattern::PATTERN_16x19, 65, 685, '21.7-21.7-21.7', 2025, 'Whiteout'],
            ['Blackout305-2025', 'Black', 305, 100, 315, TennisRacketStringPattern::PATTERN_16x19, 67, 685, '23-23-23', 2025, 'Blackout'],
            ['Blackout300-2025', 'Black', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 68, 685, '23-23-23', 2025, 'Blackout'],
        ];

        foreach ($solincoVariants as $v) {
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
                'tennis_racket_model_id' => $solincoModelMap[$v[10]]->id
            ]);
        }
    }
}
