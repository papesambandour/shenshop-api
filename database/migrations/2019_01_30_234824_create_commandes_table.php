<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->increments('id');
            $table->float('amount');
            $table->float('quantity');
            $table->string('name',100);
            $table->string('ref',100);
            $table->enum('state',['running','cancel','success']);
            $table->enum('mode_payment',['online','on_shipping']);
            $table->integer('produits_id');
            $table->index('produits_id');
            $table->integer('users_id');
            $table->index('users_id');
            $table->dateTime('validate_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
