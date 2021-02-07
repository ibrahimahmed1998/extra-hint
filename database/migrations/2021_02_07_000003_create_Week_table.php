<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeekTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'Week';

    /**
     * Run the migrations.
     * @table Week
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('ccode');
            $table->integer('from');
            $table->integer('to');
            $table->string('ccode_hour', 45);
            $table->tinyInteger('is_lec')->index();

            $table->index(["ccode"], 'fk_Week_table_Course1_idx');


            $table->foreign('ccode', 'fk_Week_table_Course1_idx')
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
