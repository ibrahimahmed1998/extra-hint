<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeadbackTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'Feadback';

    /**
     * Run the migrations.
     * @table Feadback
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
            $table->integer('fid')->index();

            $table->index(["User_id"], 'fk_Post_User1_idx');

            $table->index(["ccode"], 'fk_Post_Course1_idx');

            $table->unique(["fid"], 'pid_UNIQUE');
            
            $table->foreign('User_id', 'fk_Post_User1_idx')
                ->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
 
            $table->foreign('ccode', 'fk_Post_Course1_idx')
                ->references('ccode')->on('Course')
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
