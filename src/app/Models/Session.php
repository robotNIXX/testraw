<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'sessions';

    protected $fillable = [
        'plan_id',
        'start_date'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function exercises()
    {
        return $this->hasManyThrough(Exercise::class, SessionExercise::class, 'session_id', 'exercise_id');
    }
}
