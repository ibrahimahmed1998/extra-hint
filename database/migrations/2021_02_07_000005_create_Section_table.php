<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'Sections';

    /**
     * Run the migrations.
     * @table Sections
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('Sec_id')->index();
            $table->integer('dep_id');
            $table->string('sec_name', 45);

            $table->index(["dep_id"], 'fk_Sections_Departments1_idx');
 

            $table->foreign('dep_id', 'fk_Sections_Departments1_idx')
                ->references('dep_id')->on('Departments')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->primary(array('dep_id','Sec_id'));

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
