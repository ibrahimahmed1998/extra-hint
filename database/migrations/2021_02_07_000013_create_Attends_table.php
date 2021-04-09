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
            $table->date('day_date')->index();
            $table->tinyInteger('attend');
            $table->tinyInteger('Week_is_lec');

            $table->index(["ccode", "Week_is_lec"], 'fk_Attends_Week1_idx');

            $table->index(["Student_id"], 'fk_Student_has_Week_table_Students1_idx');


            $table->foreign('Student_id', 'fk_Student_has_Week_table_Students1_idx')
                ->references('Student_id')->on('Students')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('ccode', 'fk_Attends_Weeks1_idx')
                ->references('ccode')->on('Weeks')
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
