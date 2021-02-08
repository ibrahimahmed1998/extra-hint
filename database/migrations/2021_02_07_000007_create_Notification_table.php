<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'Notification';

    /**
     * Run the migrations.
     * @table Notification
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('nid')->index();
            $table->string('nbody', 45);
            $table->string('nheader', 45)->comment('1 warnning
2 certificate
3 etc ...');
            $table->dateTime('created_on');
            $table->integer('ntype');
            $table->integer('User_id');

            $table->index(["User_id"], 'fk_Notification_User1_idx');


            $table->foreign('User_id', 'fk_Notification_User1_idx')
                ->references('id')->on('Users')
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
