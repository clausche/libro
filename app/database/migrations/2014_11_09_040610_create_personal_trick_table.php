<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalTrickTable extends Migration {

	public function up()
    {
        Schema::create('personal_trick', function($table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned();
            $table->integer('personal_id')->unsigned();
            $table->integer('trick_id')->unsigned();
            $table->timestamps();

            $table->foreign('personal_id')
                  ->references('id')->on('personales')
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
        Schema::table('personal_trick', function($table)
        {
            $table->dropForeign('personal_trick_personal_id_foreign');
            $table->dropForeign('personal_trick_trick_id_foreign');
        });

        Schema::drop('personal_trick');
    }

}
