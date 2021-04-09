<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreRequestTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'Pre_requests';

    /**
     * Run the migrations.
     * @table Pre_request
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('ccode');
            $table->string('pr_ccode', 10);

            $table->index(["ccode"], 'fk_Pre_request_Courses1_idx');
            $table->index(["pr_ccode"], 'fk_Pre_request_Courses2_idx');


            $table->foreign('ccode', 'fk_Pre_request_Courses1_idx')
                ->references('ccode')->on('Courses')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('pr_ccode', 'fk_Pre_request_Courses2_idx')
                ->references('ccode')->on('Courses')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        $table->primary(array('ccode','pr_ccode'));

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
