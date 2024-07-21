<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
use Carbon\Carbon;


class PengunjungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $now = Carbon::now();
        $oneMonthAgo = $now->subMonth();
    	for($i = 1; $i <= 140; $i++){

    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('pengunjungs')->insert([
    			'name' => $faker->name,
    			'jenis_kelamin' => 'Wanita',
    			'kategori_usia' => 'Dewasa',
    			'kategori_pengunjung' => 'Wisatawan Umum',
                'created_at' => $faker->dateTimeBetween('2023-01-01', '2023-12-01'),
                'updated_at' => $faker->dateTimeBetween('2023-01-01', '2023-12-01'),
    		]);

    	}
    }
}
