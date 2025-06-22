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
            'Pure Aero' => TennisRacketModel::create(['name' => 'Pure Aero', 'brand_id' => $babolat->id, 'logo_url' => 'https://media.strefatenisa.com.pl/public/thumbnail/82/45/27/1721065658/1feat6augiawpd_1280x1280.jpg']),
            'Pure Drive' => TennisRacketModel::create(['name' => 'Pure Drive', 'brand_id' => $babolat->id, 'logo_url' => 'https://media.strefatenisa.com.pl/public/thumbnail/d7/8e/7f/1741250230/babolat-pure-drive-98-11-gen-bez-naciagu_1280x1280.jpg']),
            'Pure Strike' => TennisRacketModel::create(['name' => 'Pure Strike', 'brand_id' => $babolat->id, 'logo_url' => 'https://media.strefatenisa.com.pl/public/thumbnail/76/89/c9/1721056655/babolat-pure-strike-100-16-20-4-gen-bez-naciagu_1280x1280.jpg']),
        ];

        $babolatVariants = [
            ['PA100-2023', 'Yellow', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 69, 685, '23/26/23', 2023, 'Pure Aero'],
            ['PA98-2023', 'Yellow', 305, 98, 315, TennisRacketStringPattern::PATTERN_16x20, 70, 685, '21/23/22', 2023, 'Pure Aero'],
            ['PD100-2025', 'Blue', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 72, 685, '23/26/23', 2025, 'Pure Drive 11-gen'],
            ['PD98-2025', 'Blue', 305, 98, 325, TennisRacketStringPattern::PATTERN_16x20, 73, 685, '21/23/21', 2025, 'Pure Drive 98 11-gen'],
            ['PS100-16-20-2024', 'Beige', 305, 100, 310, TennisRacketStringPattern::PATTERN_16x20, 65, 685, '21/23/21', 2025, 'Pure Strike 100 16/20 4-gen'],
            ['PS100-16-19-2024', 'Beige', 300, 100, 320, TennisRacketStringPattern::PATTERN_16x19, 68, 685, '21/23/21', 2025, 'Pure Strike 100 4-gen'],
            ['PS97-2024', 'Beige', 310, 97, 310, TennisRacketStringPattern::PATTERN_16x20, 67, 685, '21/22/21', 2024, 'Pure Strike 97 4-gen'],
            ['PS98-18x20-2024', 'Beige', 305, 98, 320, TennisRacketStringPattern::PATTERN_18x20, 68, 685, '21/23/21', 2024, 'Pure Strike 18/20 4-gen'],
            ['PS98-16x19-2024', 'Beige', 305, 98, 320, TennisRacketStringPattern::PATTERN_16x19, 68, 685, '21/23/21', 2024, 'Pure Strike 16/19 4-gen'],
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
