<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateEnrollTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'Enrolls';

    /**
     * Run the migrations.
     * @table Enroll
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
            $table->integer('htotal_d')->nullable();
            $table->tinyInteger('hpass')->nullable();
            $table->integer('semester')->index();
            $table->integer('year')->index();
            $table->string('ccode', 10);

            $table->index(["Student_id"],'fk_Enrolls_Students1_idx');
            $table->index(["ccode"], 'fk_Enroll_Courses1_idx');

            $table->foreign('Student_id', 'fk_Enrolls_Students1_idx')
                ->references('Student_id')->on('Students')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('ccode', 'fk_Enrolls_Courses1_idx')
                ->references('ccode')->on('Courses')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->primary(array('semester','year','Student_id','ccode'));
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
