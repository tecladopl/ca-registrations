<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['question_type_id', 'name', 'subtext', 'input_name', 'questionnaire_page_id', 'options', 'question', 'label', 'order', 'makes_criterium'];

    public function answers()
    {
       return $this->hasMany(Answer::class)->orderBy('order');
    }

    public function questionnaire_page(){
        return $this->belongsTo(QuestionnairePage::class);
    }

    public function question_type()
    {
        return $this->belongsTo(QuestionType::class);
    }

    public function applicant_answers()
    {
        return $this->hasMany(ApplicantAnswer::class);
    }

    public function validations()
    {
        return $this->belongsToMany(Validation::class);
    }

}
