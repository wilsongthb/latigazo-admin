<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdmOutputs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm_outputs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('enable')->default(true);

            $table->decimal('quantity', 8, 2);
            $table->json('reference')->nullable(); // registro de referencia
            // $table->integer('reason_id')->unsigned();
            // $table->foreign('reason_id')->references('id')->on('adm_reasons');
            $table->integer('budget_id')->unsigned();
            $table->foreign('budget_id')->references('id')->on('adm_budgets');
            $table->text('observation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adm_outputs');
    }
}
