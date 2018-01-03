<?php

use Illuminate\Database\Seeder;
use \DB as DB;

class AdmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $entradas = [];
        $fuentes = DB::table('adm_sources')->get();
        for ($i=0; $i < 200; $i++) { 
            $entradas[] = [
                'user_id' => '1',
                'quantity' => $faker->randomFloat(2, 0, 400),
                'source_id' => $faker->numberBetween(1, count($fuentes))
            ];
        }
        

        $reasons = DB::table('adm_reasons')->get();
        // dd($reasons);
        for ($i=0; $i < 200; $i++) { 
            $lastBudget = DB::table('adm_budgets')
                ->where('reason_id', $reasons[$faker->numberBetween(0, count($reasons)-1)]->id)
                ->orderBy('id', 'DESC')
                ->first();
            
            if(count($lastBudget) === 1){
                $total = DB::select(
                    "SELECT 
                        IFNULL(SUM(o.quantity), 0) AS total
                    FROM adm_budgets AS b
                    LEFT JOIN adm_outputs AS o ON o.budget_id = b.id
                    WHERE b.id ='$lastBudget->id'"
                )[0]->total;

                $quantity = $faker->randomFloat(2, 0, 100);
                
                if(($lastBudget->max - $total) > $quantity){
                    echo "registrando $quantity" . PHP_EOL;
                    DB::table('adm_outputs')->insert([
                        'budget_id' => $lastBudget->id,
                        'quantity' => $quantity,
                        'user_id' => '1'
                    ]);
                }
            }
        }

        // entradas
        DB::table('adm_inputs')->insert($entradas);
    }
}
