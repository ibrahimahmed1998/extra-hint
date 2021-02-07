<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSctTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'SCT';

    /**
     * Run the migrations.
     * @table SCT
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('Student_id');
            $table->integer('hmedterm_d')->nullable()->comment('may be one exam may be 2 may be choose what is best from it ');
            $table->integer('hlab_d')->nullable();
            $table->integer('horal_d')->nullable();
            $table->integer('hclass_work_d')->nullable();
            $table->integer('hfinal_d')->nullable();
            $table->integer('htotal_d')->nullable()->comment('student degree of course x 
ex x_d = 150 
s_d may be 137 ');
            $table->tinyInteger('hpass')->nullable()->comment('boolean value
1 = pass
0 = not pass
');
            $table->integer('semester')->index();
            $table->increments('year')->index();
            $table->string('ccode', 10);

            $table->index(["Student_id"], 'fk_StuCourse_Rel_Student1_idx');
            $table->index(["ccode"], 'fk_SCT_Course1_idx');

            $table->foreign('Student_id', 'fk_StuCourse_Rel_Student1_idx')
                ->references('Student_id')->on('Student')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('ccode', 'fk_SCT_Course1_idx')
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
