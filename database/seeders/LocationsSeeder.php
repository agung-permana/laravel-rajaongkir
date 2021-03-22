<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Models\Province;
use App\Models\City;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        foreach ($daftarProvinsi as $provinsi) {
            Province::create([
                'province_id' => $provinsi['province_id'],
                'name' => $provinsi['province'],
            ]);
        
            $daftarKota = RajaOngkir::kota()->dariProvinsi($provinsi['province_id'])->get();
            foreach ($daftarKota as $kota) {
                City::create([
                    'province_id' => $provinsi['province_id'],
                    'city_id' => $kota['city_id'],
                    'name' => $kota['city_name'],
                ]);
            }
        }
    }
}
