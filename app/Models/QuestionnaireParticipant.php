<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Dirape\Token\Token;
use App\Models\Applicant;
use App\Models\Questionnaire;

class QuestionnaireParticipant extends Model
{
    use HasFactory;



    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }



}
