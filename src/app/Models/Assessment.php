<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $table = 'assessments';

    protected $fillable = [
        'title',
        'description',
        'domain_id',
        'score'
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class, 'domain_id');
    }
}
