<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'Attends';

    /**
     * Run the migrations.
     * @table Attends
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('ccode');
            $table->unsignedBigInteger('student_id');
            $table->integer('is_lec');
            $table->string('date');

            $table->timestamps();    

            $table->foreign('student_id', 'fk_Attends_Students1_idx')
                ->references('user_id')->on('Students')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('ccode', 'fk_Attends_Courses1_idx')
                ->references('ccode')->on('Courses')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            //$table->primary(array('Student_id','ccode',));// ,'is_lecture' 'day_date','is_attend'

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
