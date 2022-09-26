<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /** Schema table name to migrate **/
    
    public $tableName = 'Users';
    
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->id();
            $table->string('phone')->unique();
            $table->string('full_name',50);
            $table->enum('type', ['student','advisor','admin']);
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();    
        });
    }
     public function down(){Schema::dropIfExists($this->tableName);}
}
