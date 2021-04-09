<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Foundation\Auth\Student as Authenticatable;
 

class Student extends Model // extends Authenticatable implements JWTSubject
{
    use HasFactory;

    use Notifiable;
    
    public $timestamps = false;

    protected $fillable = [
        'Student_id','roadmap','live_hour' , 'total_gpa', 'current_lvl','adv_id' /* , 'dep_id' ,'sec_id'*/
    ];  

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
 
 
