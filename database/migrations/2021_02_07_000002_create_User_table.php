<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'Users';

    /**
     * Run the migrations.
     * @table Users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id',20)->index();
            $table->string('phone');
            $table->string('full_name', 50);
            $table->integer('type');
            $table->string('email', 50);
            $table->string('password');
            $table->string('rememberToken', 50)->nullable();
           // $table->timestamp('created_at')->nullable();

            $table->unique(["phone"], 'phone_UNIQUE');

            $table->unique(["id"], 'acadmic_id_UNIQUE');

            $table->unique(["email"], 'email_UNIQUE');
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
