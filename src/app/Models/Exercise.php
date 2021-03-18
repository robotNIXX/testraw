<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $table = 'exercises';

    protected $fillable = [
        'title',
        'description',
        'memory_weight',
        'reasoning_weight',
        'speed_weight',
        'attention_weight',
        'score'
    ];
}
