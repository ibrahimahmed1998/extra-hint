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
    public $tableName = 'User';

    /**
     * Run the migrations.
     * @table User
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id',20)->comment('Randomly Acadimic ID or Selected From Faculty Sys ')->index();
            $table->integer('phone');
            $table->string('full_name', 50)->comment('first name ');
            $table->integer('type')->comment('if student user type = 1
else if advisor user type = 2 
else if adminstrator user type = 3 
');
            $table->string('email', 45);
            $table->string('password');
            $table->string('rememberToken', 15)->nullable();
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
