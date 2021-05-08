<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateEnrollTable extends Migration
{
    public $tableName = 'Enrolls';

    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table)
         {
            $table->engine = 'InnoDB';

            $table->increments('counter');
            $table->integer('Student_id')->index();
            $table->integer('semester')->index();
            $table->integer('year')->index();
            $table->string('ccode', 10)->index();

            $table->integer('hmedterm_d')->nullable();
            $table->integer('hlab_d')->nullable();
            $table->integer('horal_d')->nullable();
            $table->integer('hclass_work_d')->nullable();
            $table->integer('hfinal_d')->nullable();
            $table->integer('htotal_d')->nullable();
            $table->tinyInteger('hpass')->nullable();
            $table->timestamps();    

            $table->integer('signature');
/*************************************************************************************************************/
            $table->foreign('Student_id', 'fk_Enrolls_Students1_idx')
                ->references('Student_id')->on('Students')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('ccode', 'fk_Enrolls_Courses1_idx')
                ->references('ccode')->on('Courses')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            //$table->primary(array('semester','year','Student_id','ccode'));
        });
    }
     public function down(){ Schema::dropIfExists($this->tableName); }
}
