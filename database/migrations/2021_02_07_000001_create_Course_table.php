<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'Course';

    /**
     * Run the migrations.
     * @table Course
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('ccode')->comment('comp415')->index();
            $table->string('cname', 45)->comment('compiler2');
            $table->integer('cch')->comment('course cridet hours
ex = 3');
            $table->integer('dmidterm');
            $table->integer('dlab');
            $table->integer('doral');
            $table->integer('dclass_work');
            $table->integer('dfinal');
            $table->string('dtotal', 45);
            $table->string('instructor', 45);

            $table->unique(["cname"], 'cname_UNIQUE');

            $table->unique(["ccode"], 'ccode_UNIQUE');
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
