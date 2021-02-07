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
    public $tableName = 'Section';

    /**
     * Run the migrations.
     * @table Section
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

            $table->index(["dep_id"], 'fk_Section_Department1_idx');
            $table->unique(["sec_name"], 'sec_name_UNIQUE');
            $table->unique(["Sec_id"], 'Sec_id_UNIQUE');


            $table->foreign('dep_id', 'fk_Section_Department1_idx')
                ->references('dep_id')->on('Department')
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
