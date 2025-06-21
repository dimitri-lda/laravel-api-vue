<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\TennisRacketModel;
use App\Models\TennisRacketVariant;
use App\Models\Enum\TennisRacketStringPattern;

class BabolatDataSeeder extends Seeder
{
    public function run(): void
    {
        $babolat = Brand::firstOrCreate(
            ['name' => 'Babolat'],
            [
                'logo_url' => 'https://babolat.pl/wp-content/uploads/2018/10/LOGO_150_Header_Desktop.svg',
                'country_code' => 'FR'
            ]
        );

        $babolatModelMap = [
            'Pure Aero' => TennisRacketModel::create(['name' => 'Pure Aero', 'brand_id' => $babolat->id]),
            'Pure Drive' => TennisRacketModel::create(['name' => 'Pure Drive', 'brand_id' => $babolat->id]),
            'Pure Strike' => TennisRacketModel::create(['name' => 'Pure Strike', 'brand_id' => $babolat->id]),
        ];

        $babolatVariants = [
            ['PA100-2023', 'Yellow', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 67, 685, '23-26-23', 2023, 'Pure Aero'],
            ['PA98-2023', 'Yellow', 305, 98, 315, TennisRacketStringPattern::PATTERN_16x20, 66, 685, '21-23-22', 2023, 'Pure Aero'],
            ['PD100-2021', 'Blue', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 71, 685, '23-26-23', 2021, 'Pure Drive'],
            ['PD98-2024', 'Blue', 305, 98, 315, TennisRacketStringPattern::PATTERN_16x19, 68, 685, '21.5-23-21.5', 2024, 'Pure Drive'],
            ['PS100-2024', 'Beige', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x20, 65, 685, '23-26-23', 2024, 'Pure Strike'],
            ['PS97-2024', 'Beige', 310, 97, 310, TennisRacketStringPattern::PATTERN_16x19, 64, 685, '21-23-21', 2024, 'Pure Strike'],
            ['PS98-18x20-2024', 'Beige', 305, 98, 320, TennisRacketStringPattern::PATTERN_18x20, 65, 685, '21-23-21', 2024, 'Pure Strike'],
            ['PS98-16x19-2024', 'Beige', 305, 98, 320, TennisRacketStringPattern::PATTERN_16x19, 65, 685, '21-23-21', 2024, 'Pure Strike'],
        ];

        foreach ($babolatVariants as $v) {
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
                'tennis_racket_model_id' => $babolatModelMap[$v[10]]->id
            ]);
        }
    }
}
