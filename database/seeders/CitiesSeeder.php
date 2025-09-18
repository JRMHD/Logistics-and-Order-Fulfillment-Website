<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\RateZone;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create rate zones first
        $this->createRateZones();

        // Create Kenya cities
        $this->createKenyaCities();

        // Create Tanzania cities (basic list)
        $this->createTanzaniaCities();

        // Create Uganda cities (basic list)
        $this->createUgandaCities();
    }

    private function createRateZones(): void
    {
        RateZone::updateOrCreate(['name' => 'Nairobi Metropolitan'], [
            'flat_rate' => 415.00,
            'base_rate' => null,
            'rate_per_kg' => null,
            'rate_per_km' => null,
            'is_active' => true
        ]);

        RateZone::updateOrCreate(['name' => 'Nationwide'], [
            'flat_rate' => null,
            'base_rate' => 100.00,
            'rate_per_kg' => 10.00,
            'rate_per_km' => 3.00,
            'is_active' => true
        ]);
    }

    private function createKenyaCities(): void
    {
        $kenyaCities = [
            // Major Cities
            [
                'name' => 'Nairobi',
                'normalized_name' => 'nairobi',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.2921,
                'longitude' => 36.8219,
                'is_nairobi_area' => true,
                'is_major_city' => true,
                'aliases' => ['nairobi city', 'nairobi cbd', 'cbd']
            ],
            [
                'name' => 'Mombasa',
                'normalized_name' => 'mombasa',
                'region' => 'Mombasa County',
                'country' => 'KEN',
                'latitude' => -4.0435,
                'longitude' => 39.6682,
                'is_nairobi_area' => false,
                'is_major_city' => true,
                'aliases' => ['mombasa city', 'mombasa island']
            ],
            [
                'name' => 'Kisumu',
                'normalized_name' => 'kisumu',
                'region' => 'Kisumu County',
                'country' => 'KEN',
                'latitude' => -0.1022,
                'longitude' => 34.7617,
                'is_nairobi_area' => false,
                'is_major_city' => true,
                'aliases' => ['kisumu city']
            ],
            [
                'name' => 'Nakuru',
                'normalized_name' => 'nakuru',
                'region' => 'Nakuru County',
                'country' => 'KEN',
                'latitude' => -0.3031,
                'longitude' => 36.0800,
                'is_nairobi_area' => false,
                'is_major_city' => true,
                'aliases' => ['nakuru town']
            ],
            [
                'name' => 'Eldoret',
                'normalized_name' => 'eldoret',
                'region' => 'Uasin Gishu County',
                'country' => 'KEN',
                'latitude' => 0.5143,
                'longitude' => 35.2698,
                'is_nairobi_area' => false,
                'is_major_city' => true,
                'aliases' => ['eldoret town']
            ],

            // Nairobi Metropolitan Areas
            [
                'name' => 'Westlands',
                'normalized_name' => 'westlands',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.2676,
                'longitude' => 36.8108,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['westlands area']
            ],
            [
                'name' => 'Karen',
                'normalized_name' => 'karen',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.3197,
                'longitude' => 36.6859,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['karen area']
            ],
            [
                'name' => 'Langata',
                'normalized_name' => 'langata',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.3644,
                'longitude' => 36.7361,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['langata area']
            ],
            [
                'name' => 'Kasarani',
                'normalized_name' => 'kasarani',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.2258,
                'longitude' => 36.8969,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['kasarani area']
            ],
            [
                'name' => 'Embakasi',
                'normalized_name' => 'embakasi',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.3167,
                'longitude' => 36.8833,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['embakasi area']
            ],
            [
                'name' => 'Dagoretti',
                'normalized_name' => 'dagoretti',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.3000,
                'longitude' => 36.7500,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['dagoretti corner']
            ],
            [
                'name' => 'Kibra',
                'normalized_name' => 'kibra',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.3133,
                'longitude' => 36.7833,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['kibera']
            ],
            [
                'name' => 'Mathare',
                'normalized_name' => 'mathare',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.2667,
                'longitude' => 36.8667,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['mathare area']
            ],
            [
                'name' => 'Starehe',
                'normalized_name' => 'starehe',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.2833,
                'longitude' => 36.8333,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['starehe area']
            ],
            [
                'name' => 'Kamukunji',
                'normalized_name' => 'kamukunji',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.2833,
                'longitude' => 36.8500,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['kamukunji area']
            ],
            [
                'name' => 'Makadara',
                'normalized_name' => 'makadara',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.3000,
                'longitude' => 36.8500,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['makadara area']
            ],
            [
                'name' => 'Roysambu',
                'normalized_name' => 'roysambu',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.2167,
                'longitude' => 36.8833,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['roysambu area']
            ],
            [
                'name' => 'Ruaraka',
                'normalized_name' => 'ruaraka',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.2500,
                'longitude' => 36.8833,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['ruaraka area']
            ],
            [
                'name' => 'Kilimani',
                'normalized_name' => 'kilimani',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.2833,
                'longitude' => 36.7833,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['kilimani area']
            ],
            [
                'name' => 'Lavington',
                'normalized_name' => 'lavington',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.2833,
                'longitude' => 36.7667,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['lavington area']
            ],
            [
                'name' => 'Runda',
                'normalized_name' => 'runda',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.2167,
                'longitude' => 36.8167,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['runda estate']
            ],
            [
                'name' => 'Muthaiga',
                'normalized_name' => 'muthaiga',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.2500,
                'longitude' => 36.8167,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['muthaiga estate']
            ],
            [
                'name' => 'Parklands',
                'normalized_name' => 'parklands',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.2667,
                'longitude' => 36.8333,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['parklands area']
            ],
            [
                'name' => 'Eastleigh',
                'normalized_name' => 'eastleigh',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.2833,
                'longitude' => 36.8500,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['eastleigh area']
            ],
            [
                'name' => 'South C',
                'normalized_name' => 'south c',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.3167,
                'longitude' => 36.8167,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['south c estate']
            ],
            [
                'name' => 'South B',
                'normalized_name' => 'south b',
                'region' => 'Nairobi County',
                'country' => 'KEN',
                'latitude' => -1.3000,
                'longitude' => 36.8167,
                'is_nairobi_area' => true,
                'is_major_city' => false,
                'aliases' => ['south b estate']
            ],

            // Major Towns Outside Nairobi
            [
                'name' => 'Thika',
                'normalized_name' => 'thika',
                'region' => 'Kiambu County',
                'country' => 'KEN',
                'latitude' => -1.0332,
                'longitude' => 37.0694,
                'is_nairobi_area' => false,
                'is_major_city' => true,
                'aliases' => ['thika town']
            ],
            [
                'name' => 'Nyeri',
                'normalized_name' => 'nyeri',
                'region' => 'Nyeri County',
                'country' => 'KEN',
                'latitude' => -0.4167,
                'longitude' => 36.9500,
                'is_nairobi_area' => false,
                'is_major_city' => true,
                'aliases' => ['nyeri town']
            ],
            [
                'name' => 'Meru',
                'normalized_name' => 'meru',
                'region' => 'Meru County',
                'country' => 'KEN',
                'latitude' => 0.0467,
                'longitude' => 37.6500,
                'is_nairobi_area' => false,
                'is_major_city' => true,
                'aliases' => ['meru town']
            ],
            [
                'name' => 'Machakos',
                'normalized_name' => 'machakos',
                'region' => 'Machakos County',
                'country' => 'KEN',
                'latitude' => -1.5177,
                'longitude' => 37.2634,
                'is_nairobi_area' => false,
                'is_major_city' => false,
                'aliases' => ['machakos town']
            ],
            [
                'name' => 'Kitui',
                'normalized_name' => 'kitui',
                'region' => 'Kitui County',
                'country' => 'KEN',
                'latitude' => -1.3667,
                'longitude' => 38.0167,
                'is_nairobi_area' => false,
                'is_major_city' => false,
                'aliases' => ['kitui town']
            ],
            [
                'name' => 'Garissa',
                'normalized_name' => 'garissa',
                'region' => 'Garissa County',
                'country' => 'KEN',
                'latitude' => -0.4569,
                'longitude' => 39.6582,
                'is_nairobi_area' => false,
                'is_major_city' => false,
                'aliases' => ['garissa town']
            ],
            [
                'name' => 'Kakamega',
                'normalized_name' => 'kakamega',
                'region' => 'Kakamega County',
                'country' => 'KEN',
                'latitude' => 0.2827,
                'longitude' => 34.7519,
                'is_nairobi_area' => false,
                'is_major_city' => false,
                'aliases' => ['kakamega town']
            ],
            [
                'name' => 'Kericho',
                'normalized_name' => 'kericho',
                'region' => 'Kericho County',
                'country' => 'KEN',
                'latitude' => -0.3676,
                'longitude' => 35.2861,
                'is_nairobi_area' => false,
                'is_major_city' => false,
                'aliases' => ['kericho town']
            ],
            [
                'name' => 'Embu',
                'normalized_name' => 'embu',
                'region' => 'Embu County',
                'country' => 'KEN',
                'latitude' => -0.5396,
                'longitude' => 37.4513,
                'is_nairobi_area' => false,
                'is_major_city' => false,
                'aliases' => ['embu town']
            ],
            [
                'name' => 'Kiambu',
                'normalized_name' => 'kiambu',
                'region' => 'Kiambu County',
                'country' => 'KEN',
                'latitude' => -1.1712,
                'longitude' => 36.8356,
                'is_nairobi_area' => false,
                'is_major_city' => false,
                'aliases' => ['kiambu town']
            ],
            [
                'name' => 'Murang\'a',
                'normalized_name' => 'muranga',
                'region' => 'Murang\'a County',
                'country' => 'KEN',
                'latitude' => -0.7167,
                'longitude' => 37.1500,
                'is_nairobi_area' => false,
                'is_major_city' => false,
                'aliases' => ['muranga town', 'murang\'a town']
            ],
            [
                'name' => 'Malindi',
                'normalized_name' => 'malindi',
                'region' => 'Kilifi County',
                'country' => 'KEN',
                'latitude' => -3.2167,
                'longitude' => 40.1167,
                'is_nairobi_area' => false,
                'is_major_city' => false,
                'aliases' => ['malindi town']
            ],
            [
                'name' => 'Lamu',
                'normalized_name' => 'lamu',
                'region' => 'Lamu County',
                'country' => 'KEN',
                'latitude' => -2.2717,
                'longitude' => 40.9020,
                'is_nairobi_area' => false,
                'is_major_city' => false,
                'aliases' => ['lamu island', 'lamu town']
            ],
            [
                'name' => 'Naivasha',
                'normalized_name' => 'naivasha',
                'region' => 'Nakuru County',
                'country' => 'KEN',
                'latitude' => -0.7167,
                'longitude' => 36.4333,
                'is_nairobi_area' => false,
                'is_major_city' => false,
                'aliases' => ['naivasha town']
            ],
            [
                'name' => 'Nanyuki',
                'normalized_name' => 'nanyuki',
                'region' => 'Laikipia County',
                'country' => 'KEN',
                'latitude' => 0.0167,
                'longitude' => 37.0833,
                'is_nairobi_area' => false,
                'is_major_city' => false,
                'aliases' => ['nanyuki town']
            ]
        ];

        foreach ($kenyaCities as $cityData) {
            City::updateOrCreate(
                ['normalized_name' => $cityData['normalized_name'], 'country' => 'KEN'],
                $cityData
            );
        }
    }

    private function createTanzaniaCities(): void
    {
        $tanzaniaCities = [
            [
                'name' => 'Dar es Salaam',
                'normalized_name' => 'dar es salaam',
                'region' => 'Dar es Salaam Region',
                'country' => 'TZS',
                'latitude' => -6.7924,
                'longitude' => 39.2083,
                'is_nairobi_area' => false,
                'is_major_city' => true,
                'aliases' => ['dar', 'dar es salaam city']
            ],
            [
                'name' => 'Dodoma',
                'normalized_name' => 'dodoma',
                'region' => 'Dodoma Region',
                'country' => 'TZS',
                'latitude' => -6.1630,
                'longitude' => 35.7516,
                'is_nairobi_area' => false,
                'is_major_city' => true,
                'aliases' => ['dodoma city']
            ],
            [
                'name' => 'Arusha',
                'normalized_name' => 'arusha',
                'region' => 'Arusha Region',
                'country' => 'TZS',
                'latitude' => -3.3869,
                'longitude' => 36.6830,
                'is_nairobi_area' => false,
                'is_major_city' => true,
                'aliases' => ['arusha city']
            ]
        ];

        foreach ($tanzaniaCities as $cityData) {
            City::updateOrCreate(
                ['normalized_name' => $cityData['normalized_name'], 'country' => 'TZS'],
                $cityData
            );
        }
    }

    private function createUgandaCities(): void
    {
        $ugandaCities = [
            [
                'name' => 'Kampala',
                'normalized_name' => 'kampala',
                'region' => 'Central Uganda',
                'country' => 'UGA',
                'latitude' => 0.3476,
                'longitude' => 32.5825,
                'is_nairobi_area' => false,
                'is_major_city' => true,
                'aliases' => ['kampala city']
            ],
            [
                'name' => 'Entebbe',
                'normalized_name' => 'entebbe',
                'region' => 'Central Uganda',
                'country' => 'UGA',
                'latitude' => 0.0514,
                'longitude' => 32.4790,
                'is_nairobi_area' => false,
                'is_major_city' => false,
                'aliases' => ['entebbe town']
            ],
            [
                'name' => 'Jinja',
                'normalized_name' => 'jinja',
                'region' => 'Eastern Uganda',
                'country' => 'UGA',
                'latitude' => 0.4314,
                'longitude' => 33.2042,
                'is_nairobi_area' => false,
                'is_major_city' => false,
                'aliases' => ['jinja city']
            ]
        ];

        foreach ($ugandaCities as $cityData) {
            City::updateOrCreate(
                ['normalized_name' => $cityData['normalized_name'], 'country' => 'UGA'],
                $cityData
            );
        }
    }
}