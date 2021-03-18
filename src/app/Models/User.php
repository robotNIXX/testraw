<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $table = 'users';

    public function plans()
    {
        return $this->hasMany(Plan::class, 'user_id');
    }

    public function assessments()
    {
        return $this->hasManyThrough(Assessment::class, UserAssessment::class, 'user_id' . 'assessment_id');
    }

    public function sessions() {
        return $this->hasManyThrough(Session::class, Plan::class, 'user_id', 'plan_id');
    }
}
