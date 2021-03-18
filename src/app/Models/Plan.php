<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plans';

    protected $fillable = [
        'title',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'plan_id');
    }
}
