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
    public $tableName = 'Shcs';

    /**
     * Run the migrations.
     * @table SHC
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) 
        {
            $table->engine = 'InnoDB';
            $table->integer('Sec_id');
            $table->integer('dep_id');
            $table->string('ccode');
            $table->double('c_theoretical_ratio');
            $table->tinyInteger('c_elective');
            $table->integer('c_semester');
            $table->string('c_lvl', 5);

            $table->index(["dep_id"], 'fk_Shcs_Sections2_idx');
            $table->index(["Sec_id"], 'fk_Shcs_Sections1_idx');
            $table->index(["ccode"], 'fk_Shcs_Courses1_idx');


            $table->foreign('Sec_id', 'fk_Shcs_Sections1_idx')
                ->references('Sec_id')->on('Sections')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('dep_id', 'fk_Shcs_Sections2_idx')
            ->references('dep_id')->on('Sections')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('ccode', 'fk_Shcs_Courses1_idx')
                ->references('ccode')->on('Courses')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->primary(array('Sec_id','dep_id','ccode'));
            

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
