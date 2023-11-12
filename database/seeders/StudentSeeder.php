<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 20) as $index) {
            $nama = $faker->name;
            $npm = $faker->unique()->numerify('########');
            $statusLulus = $faker->boolean(); // Menghasilkan true (tepat waktu) atau false (tidak tepat waktu)
            
            // Generate IPS values based on status
            $ips1 = $statusLulus ? $faker->randomFloat(2, 2.5, 4) : $faker->randomFloat(2, 0, 2.4);
            $ips2 = $statusLulus ? $faker->randomFloat(2, 2.5, 4) : $faker->randomFloat(2, 0, 2.4);
            $ips3 = $statusLulus ? $faker->randomFloat(2, 2.5, 4) : $faker->randomFloat(2, 0, 2.4);
            $ips4 = $statusLulus ? $faker->randomFloat(2, 2.5, 4) : $faker->randomFloat(2, 0, 2.4);
            $ips5 = $statusLulus ? $faker->randomFloat(2, 2.5, 4) : $faker->randomFloat(2, 0, 2.4);

            DB::table('students')->insert([
                'nama' => $nama,
                'npm' => $npm,
                'ips1' => $ips1,
                'ips2' => $ips2,
                'ips3' => $ips3,
                'ips4' => $ips4,
                'ips5' => $ips5,
                'status' => $statusLulus,
            ]);
        }

    }
}
