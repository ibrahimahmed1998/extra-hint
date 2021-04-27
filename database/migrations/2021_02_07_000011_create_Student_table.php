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
            $table->integer('Student_id');
            $table->integer('roadmap');
            $table->integer('live_hour');
            $table->float('c_gpa')->nullable();
            $table->integer('lvl')->nullable();
            $table->integer('adv_id')->nullable();
            $table->integer('Dep_id');
            $table->integer('Sec_id');

            $table->index(["Sec_id", "Dep_id"], 'fk_Student_Sections1_idx');
            $table->index(["adv_id"], 'fk_S_Users1_idx');
            $table->index(["Student_id"], 'fk_S_Users2_idx');

            $table->foreign('adv_id', 'fk_S_User2_idx')
                ->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

                $table->foreign('Student_id', 'fk_S_Users1_idx')
                ->references('id')->on('Users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('Sec_id', 'fk_Student_Sections1_idx')
                ->references('Sec_id')->on('Sections')
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
