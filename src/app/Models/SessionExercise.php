<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SessionExercise extends Model
{
    protected $table = 'session_exercises';

    protected $fillable = [
        'session_id',
        'exercise_id',
        'is_completed'
    ];
}
