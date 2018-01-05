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
            $table->boolean('authorized')->default(false); // fue autorizado
            $table->integer('authorizer')->unsigned()->nullable(); // id de usuario que lo autorizo
            $table->dateTime('authorized_time')->nullable(); // fecha de autorizacion

            // $table->integer('budget_id')->unsigned();
            // $table->foreign('budget_id')->references('id')->on('adm_budgets');
            $table->integer('budget_id')->unsigned()->nullable();
            // $table->integer('reason_id')->unsigned()->nullable();
            $table->integer('reason_id')->unsigned();
            $table->foreign('reason_id')->references('id')->on('adm_reasons');

            $table->text('observation')->nullable();
            $table->tinyInteger('type_id')->default('1');
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
