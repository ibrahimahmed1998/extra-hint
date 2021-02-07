<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShcTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'SHC';

    /**
     * Run the migrations.
     * @table SHC
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('dep_id');
            $table->integer('Sec_id');
            $table->string('ccode');
            $table->double('c_theoretical_ratio');
            $table->tinyInteger('c_elective')->comment('if course is optional may be student select it or not ');
            $table->integer('c_semester')->comment('which semester intrduce this course');
            $table->string('c_lvl', 45);

            $table->index(["dep_id"], 'fk_SHC_Section2_idx');
            $table->index(["Sec_id"], 'fk_SHC_Section1_idx');
            $table->index(["ccode"], 'fk_SHC_Course1_idx');


            $table->foreign('Sec_id', 'fk_SHC_Section1_idx')
                ->references('Sec_id')->on('Section')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->foreign('dep_id', 'fk_SHC_Section2_idx')
            ->references('dep_id')->on('Section')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('ccode', 'fk_SHC_Course1_idx')
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
