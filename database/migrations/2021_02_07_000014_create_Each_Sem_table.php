<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEachSemTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'Each_Sem';

    /**
     * Run the migrations.
     * @table Each_Sem
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('Student_id');
            $table->integer('semester_num')->index();
            $table->integer('year')->index();
            $table->double('semester_gpa')->nullable();
            $table->integer('lvl');
            $table->double('total_gpa');

            $table->index(["Student_id"], 'fk_Each_Semester_Students1_idx');


            $table->foreign('Student_id', 'fk_Each_Semester_Students1_idx')
                ->references('Student_id')->on('Students')
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
