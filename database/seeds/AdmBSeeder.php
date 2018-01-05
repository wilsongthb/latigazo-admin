<?php

use Illuminate\Database\Seeder;
use \DB as DB;

class AdmBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $initTime = new DateTime;
        DB::table('users')->insert([
            ['name' => 'Root', 'email' => 'root@root', 'password' => bcrypt('root')]
        ]);

        DB::table('areas')->insert([
            ['name' => 'RECEPCION', 'user_id' => '1'],
            ['name' => 'LABORATORIO', 'user_id' => '1'],
            ['name' => 'LOGISTICA', 'user_id' => '1']
        ]);

        DB::table('adm_sources')->insert([
            ['title' => 'VENTA', 'area_id' => '1', 'user_id' => '1'],
            ['title' => 'DONACION', 'area_id' => '1', 'user_id' => '1'],
            ['title' => 'VENTA', 'area_id' => '2', 'user_id' => '1'],
            ['title' => 'REGALO', 'area_id' => '3', 'user_id' => '1'],
            ['title' => 'DEVOLUCION', 'area_id' => '3', 'user_id' => '1'],
            ['title' => 'INVERSION EXTERNA', 'area_id' => '2', 'user_id' => '1'],
            ['title' => 'CAFETERIA', 'area_id' => '2', 'user_id' => '1'],
        ]);

        DB::table('adm_reasons')->insert([
            ['title' => 'COMPRA', 'area_id' => '1', 'user_id' => '1'],
            ['title' => 'MATERIALES', 'area_id' => '1', 'user_id' => '1'],
            ['title' => 'DEVOLUCIONES', 'area_id' => '2', 'user_id' => '1'],
            ['title' => 'REGALO', 'area_id' => '3', 'user_id' => '1'],
            ['title' => 'PAGOS', 'area_id' => '3', 'user_id' => '1'],
            ['title' => 'VARIOS', 'area_id' => '2', 'user_id' => '1'],
        ]);

        $reasons = DB::table('adm_reasons')->get();
        $budgets = [];
        for ($i=0; $i < 30; $i++) { 
            $budgets[] = ['user_id' => '1', 'max' => $faker->randomFloat(2, 100, 400), 'reason_id' => $faker->numberBetween(1, count($reasons))];
        }
        DB::table('adm_budgets')->insert($budgets);
    }
}
