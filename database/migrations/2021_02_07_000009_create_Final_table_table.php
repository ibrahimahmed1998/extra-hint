<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalTableTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'Final_table';

    /**
     * Run the migrations.
     * @table Final_table
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('ccode');
            $table->date('date')->nullable();
            $table->integer('from');
            $table->integer('to');
            $table->integer('day_id');

            $table->index(["ccode"], 'fk_Final_table_Course1_idx');


            $table->foreign('ccode', 'fk_Final_table_Course1_idx')
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
