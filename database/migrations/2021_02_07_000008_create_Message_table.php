<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'Message';

    /**
     * Run the migrations.
     * @table Message
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('mid')->index();
            $table->integer('User_id');
            $table->string('mbody');
            $table->dateTime('m_timestamp');

            $table->index(["User_id"], 'fk_Message_User1_idx');


            $table->foreign('User_id', 'fk_Message_User1_idx')
                ->references('id')->on('User')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
