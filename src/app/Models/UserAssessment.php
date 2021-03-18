<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserAssessment extends Model
{
    protected $table = 'user_assessments';

    protected $fillable = [
        'user_id',
        'assessment_id',
        'is_completed',
        'start_date'
    ];
}
