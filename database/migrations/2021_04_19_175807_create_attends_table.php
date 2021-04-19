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
            $table->integer('Student_id');
            $table->date('day_date');
            $table->tinyInteger('is_attend');
            $table->tinyInteger('is_lecture');

            $table->foreign('Student_id', 'fk_Attends_Students1_idx')
                ->references('Student_id')->on('Students')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('ccode', 'fk_Attends_Courses1_idx')
                ->references('ccode')->on('Courses')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->primary(array('Student_id','ccode','day_date','is_attend','is_lecture'));

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
