<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PengajuanDataPenjaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 100; $i++) {
            $latitude = -6.80 + ($i * 0.0001);
            $longitude = 107.57 + ($i * 0.0001);

            $kapasitas = $faker->randomElement([1, 2]);
            $status = $faker->randomElement(['pending', 'disetujui', 'ditolak']);
            $comment = ($status == 'ditolak') ? $faker->sentence : null;

            $kodePenjamin = ($status == 'disetujui') ? $this->generate_random_code() : null;

            DB::table('nama_tabel_anda')->insert([
                'alamat' => $faker->address,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'foto_tempat_tinggal' => $faker->imageUrl(),
                'kapasitas' => $kapasitas,
                'status' => $status,
                'comment' => $comment,
                'kode_penjamin' => $kodePenjamin,
                'id_penjamin' => $i,
                'id_biro_kemahasiswaan' => $faker->numberBetween(1, 5),
            ]);
        }
    }

    public function generate_random_code()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';

        $currentYear = date('y');

        $currentMonth = date('n');

        if ($currentMonth >= 6 && $currentMonth <= 11) {
            $code .= '1';
        } else {
            $code .= '2';
        }

        for ($i = 0; $i < 4; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }

        return "P{$currentYear}{$code}";
    }
}
