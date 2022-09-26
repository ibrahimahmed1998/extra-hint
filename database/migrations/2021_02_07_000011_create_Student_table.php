<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'Students';

    /**
     * Run the migrations.
     * @table Students
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('user_id');
            $table->integer('roadmap')->nullable();
            $table->integer('live_hour');
            $table->float('c_gpa');
            $table->integer('lvl');
            $table->integer('adv_id')->nullable();
            $table->integer('Dep_id')->nullable();
            $table->integer('Sec_id')->nullable();

            $table->index(["Sec_id", "Dep_id"], 'fk_Student_Sections1_idx');
            $table->index(["adv_id"], 'fk_Students_Users1_idx');

            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('Sec_id', 'fk_Students_Sections1_idx')
                ->references('Sec_id')->on('Sections')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }
     public function down(){Schema::dropIfExists($this->tableName);}
}
