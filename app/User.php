<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department(){
        return $this->belongsTo('App\Department','department_id');
    }

    public function hasDepartment($userId)
    {
        return \DB::select('select count(*) as "count" from user_deartments where user_id = '.$userId)[0]->count;
    }

    public static function departmentName($id){
        $lang = \Lang::getLocale();
        return \DB::select('select user_deartments.department_id as "id",departments.'.$lang.'_name as "name" from user_deartments inner join departments on departments.id = user_deartments.department_id inner join users on users.id = user_deartments.user_id where user_deartments.user_id = '.$id)[0];
    }

    public static function checkCustomer($id){
        $customers_users_id = [];
        $customers = Customer::where('user_id',$id)->count();
        if ($customers > 0) {
            return "customer";
        }else{
            return "admin";
        }
    }
}
