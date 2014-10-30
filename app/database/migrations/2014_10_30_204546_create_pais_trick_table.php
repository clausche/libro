<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaisTrickTable extends Migration {

	public function up()
    {
        Schema::create('pais_trick', function($table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned();
            $table->integer('pais_id')->unsigned();
            $table->integer('trick_id')->unsigned();
            $table->timestamps();

            $table->foreign('pais_id')
                  ->references('id')->on('paises')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('trick_id')
                  ->references('id')->on('tricks')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('pais_trick', function($table)
        {
            $table->dropForeign('pais_trick_pais_id_foreign');
            $table->dropForeign('pais_trick_trick_id_foreign');
        });

        Schema::drop('pais_trick');
    }

}
