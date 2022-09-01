<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'Accounts';

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

            $table->bigIncrements("id");
            $table->integer('account_type'); // twfeer - gary - ...

            $table->integer('ivr_num');
            $table->boolean('ivr_state');

            $table->double('current_currency');
            $table->double('available_currency');

            $table->foreign('id')->references('id')->on('Users')->onDelete('cascade')->onUpdate('cascade');

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
