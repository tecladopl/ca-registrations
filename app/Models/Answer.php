<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['order', 'question_id', 'text', 'subtext', 'options', 'points', 'created_at', 'updated_at'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function validations()
    {
        return $this->belongsToMany(Validation::class);
    }

    public function applicant_answers()
    {
        return $this->hasMany(ApplicantAnswer::class);
    }
}
