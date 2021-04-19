<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeadbackTable extends Migration
{
    public $tableName = 'Feedbacks';
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('User_id');
            $table->string('ccode', 10);
            $table->string('fheader', 45);
            $table->string('fbody');
            $table->integer('fvote')->nullable();
            $table->increments('fid')->index();

            $table->index(["User_id"], 'fk_Posts_User1_idx');

            $table->index(["ccode"], 'fk_Posts_Courses1_idx');

            $table->unique(["fid"], 'pid_UNIQUE');
            
            $table->foreign('User_id', 'fk_Posts_Users1_idx')
                ->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
 
            $table->foreign('ccode', 'fk_Posts_Courses1_idx')
                ->references('ccode')->on('Courses')
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
        Schema::dropIfExists('feadback');
    }
}
