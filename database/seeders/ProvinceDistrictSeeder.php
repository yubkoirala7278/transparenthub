<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProvinceDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $provinces = [
            [
                'name'      => 'Koshi Province',
                'slug'      => Str::slug('Province No. 1'),
                'districts' => [
                    'Bhojpur',
                    'Dhankuta',
                    'Ilam',
                    'Jhapa',
                    'Khotang',
                    'Morang',
                    'Okhaldhunga',
                    'Panchthar',
                    'Sankhuwasabha',
                    'Solukhumbu',
                    'Sunsari',
                    'Taplejung',
                    'Terhathum',
                    'Udayapur',
                ],
            ],
            [
                'name'      => 'Madhesh Province',
                'slug'      => Str::slug('Province No. 2'),
                'districts' => [
                    'Bara',
                    'Dhanusha',
                    'Mahottari',
                    'Parsa',
                    'Rautahat',
                    'Saptari',
                    'Sarlahi',
                    'Siraha',
                ],
            ],
            [
                'name'      => 'Bagmati Province',
                'slug'      => Str::slug('Bagmati Province'),
                'districts' => [
                    'Bhaktapur',
                    'Chitwan',
                    'Dhading',
                    'Dolakha',
                    'Kathmandu',
                    'Kavrepalanchok',
                    'Lalitpur',
                    'Makwanpur',
                    'Nuwakot',
                    'Ramechhap',
                    'Rasuwa',
                    'Sindhuli',
                    'Sindhupalchok',
                ],
            ],
            [
                'name'      => 'Gandaki Province',
                'slug'      => Str::slug('Gandaki Province'),
                'districts' => [
                    'Baglung',
                    'Gorkha',
                    'Kaski',
                    'Lamjung',
                    'Manang',
                    'Mustang',
                    'Myagdi',
                    'Nawalpur',
                    'Parbat',
                    'Syangja',
                    'Tanahun',
                ],
            ],
            [
                'name'      => 'Lumbini Province',
                'slug'      => Str::slug('Lumbini Province'),
                'districts' => [
                    'Arghakhanchi',
                    'Banke',
                    'Bardiya',
                    'Dang',
                    'Gulmi',
                    'Kapilvastu',
                    'Nawalparasi', // often known as Parasi or Nawalparasi (West)
                    'Palpa',
                    'Rupandehi',
                    'Pyuthan',
                    'Rolpa',
                    'Rukum East',
                ],
            ],
            [
                'name'      => 'Karnali Province',
                'slug'      => Str::slug('Karnali Province'),
                'districts' => [
                    'Dolpa',
                    'Humla',
                    'Jumla',
                    'Kalikot',
                    'Mugu',
                    'Surkhet',
                    'Dailekh',
                    'Jajarkot',
                    'Rukum West',
                    'Salyan',
                ],
            ],
            [
                'name'      => 'Sudurpashchim Province',
                'slug'      => Str::slug('Sudurpashchim Province'),
                'districts' => [
                    'Achham',
                    'Baitadi',
                    'Darchula',
                    'Dadeldhura',
                    'Doti',
                    'Kailali',
                    'Kanchanpur',
                    'Bajura',
                    'Bajhang',
                ],
            ],
        ];

        foreach ($provinces as $provinceData) {
            // Insert the province and get its ID
            $provinceId = DB::table('provinces')->insertGetId([
                'name'       => $provinceData['name'],
                'slug'       => $provinceData['slug'],
                'status'     => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert each district for the current province
            foreach ($provinceData['districts'] as $districtName) {
                DB::table('districts')->insert([
                    'name'       => $districtName,
                    'slug'       => Str::slug($districtName),
                    'province_id'=> $provinceId,
                    'status'     => 'active',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
