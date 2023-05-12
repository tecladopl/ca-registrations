<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\ApplicantAnswer;
use App\Models\Question;
use App\Models\QuestionnairePage;
use App\Models\QuestionnaireParticipant;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use Illuminate\Support\Facades\DB;


class StaticticsController extends Controller
{

    public $questionnaire;

    public function indexAdmin()
    {
        $questionnaire_id = auth()->user()->getCurrentQuestionnaire();
        if (empty($questionnaire_id) || Questionnaire::where('id', $questionnaire_id)->get()->isEmpty()) {
            $questionnaire = Questionnaire::first();
            if (!empty($questionnaire)) {
                $questionnaire_id = $questionnaire->id;
                auth()->user()->setCurrentQuestionnaire($questionnaire_id);
            }

        }
        $this->questionnaire = Questionnaire::where('id', $questionnaire_id)->first();
        if(!empty($this->questionnaire)){
            $questionnairePages = QuestionnairePage::where('questionnaire_id', $this->questionnaire->id)->get();
            $questionnairePagesIds = $questionnairePages->pluck('id')->toArray();
            $questions = Question::whereIn('questionnaire_page_id', $questionnairePagesIds)->with('answers')->orderBy('order')->get();
            $questionsIds = $questions->pluck('id')->toArray();
            //$questions = $questions->chunk(4);
            $appliantAnswers = ApplicantAnswer::whereIn('question_id', $questionsIds)->with('question')
                ->with('applicant')
                ->with('answers')
                ->whereHas('applicant', function ($query) {
                    return $query->where('questionnaire_completed', '=', 1)->with('questionnaireParticipant');
                })->get();
            $applicants = Applicant::where('questionnaire_completed', '=', 1)->where('questionnaire_id', $this->questionnaire->id)->with('questionnaireParticipant')->get();
            $data = [];
            foreach ($questions as $key => $question) {
                foreach ($appliantAnswers as $appliantAnswer) {
                    if ($question->id == $appliantAnswer->question->id) {
                        if (isset($appliantAnswer->answers->text)) {
                            if (!isset($data[$question->name][$appliantAnswer->answers->text])) {
                                $data[$question->name][$appliantAnswer->answers->text] = 1;
                            } else {
                                $data[$question->name][$appliantAnswer->answers->text]++;
                            }
                        }
                    }
                }
            }
            //dd($data);
            $data2 = [];
            foreach ($appliantAnswers as $appliantAnswer) {
                foreach ($questions as $key => $question) {
                    if ($question->id == $appliantAnswer->question->id) {
                        if (isset($appliantAnswer->answers->text)) {
                            $data2[$appliantAnswer->applicant->id]['questions'][$question->name] = $appliantAnswer->answers->text;
                            $data2[$appliantAnswer->applicant->id]['data'] = $appliantAnswer->applicant;
                            $data2[$appliantAnswer->applicant->id]['questionnaireParticipant'] = $appliantAnswer->applicant->questionnaireParticipant;
                        } else {
                            $data2[$appliantAnswer->applicant->id]['questions'][$question->name] = $appliantAnswer->answer;
                            $data2[$appliantAnswer->applicant->id]['data'] = $appliantAnswer->applicant;
                            $data2[$appliantAnswer->applicant->id]['questionnaireParticipant'] = $appliantAnswer->applicant->questionnaireParticipant;
                        }
                    } elseif (!isset($data2[$appliantAnswer->applicant->id]['questions'][$question->name])) {
                        $data2[$appliantAnswer->applicant->id]['questions'][$question->name] = "";
                    }
                }
            }

            $questions = $questions->pluck('name')->toArray();
        }else{
            $data = [];
            $data2 = [];
            $questions = [];
        }
        


        return view('statistics.index')->with(['data' => $data, 'data2' => $data2, 'questions' => $questions]);
    }

    public function result()
    {


        $questionnairePages = QuestionnairePage::where('questionnaire_id', $this->questionnaire->id)->get();
        $questionnairePagesIds = $questionnairePages->pluck('id')->toArray();
        $questions = Question::whereIn('questionnaire_page_id', $questionnairePagesIds)->with('answers')->orderBy('order')->get();
        $questionsIds = $questions->pluck('id')->toArray();
        //$questions = $questions->chunk(4);
        $appliantAnswers = ApplicantAnswer::whereIn('question_id', $questionsIds)->with('question')
            ->with('applicant')
            ->with('answers')
            ->whereHas('applicant', function ($query) {
                return $query->where('questionnaire_completed', '=', 1);
            })->get();
        $applicants = Applicant::where('questionnaire_completed', '=', 1)->where('questionnaire_id', $this->questionnaire->id)->with('questionnaireParticipant')->get();
        $data = [];
        foreach ($questions as $key => $question) {
            foreach ($appliantAnswers as $appliantAnswer) {
                if ($question->id == $appliantAnswer->question->id) {
                    if (isset($appliantAnswer->answers->text)) {
                        if (!isset($data[$question->name][$appliantAnswer->answers->text])) {
                            $data[$question->name][$appliantAnswer->answers->text] = 1;
                        } else {
                            $data[$question->name][$appliantAnswer->answers->text]++;
                        }
                    }
                }
            }
        }
        //dd($data);
        $data2 = [];
        foreach ($applicants as $applicant_key => $applicant) {
            foreach ($appliantAnswers as $appliantAnswer) {
                foreach ($questions as $key => $question) {
                    if ($question->id == $appliantAnswer->question->id) {
                        if (isset($appliantAnswer->answers->text)) {
                            $data2[$applicant_key]['questions'][$question->name] = $appliantAnswer->answers->text;
                            $data2[$applicant_key]['data'] = $applicant;
                            $data2[$applicant_key]['questionnaireParticipant'] = $applicant->questionnaireParticipant;
                        } else {
                            $data2[$applicant_key]['questions'][$question->name] = $appliantAnswer->answer;
                            $data2[$applicant_key]['data'] = $applicant;
                            $data2[$applicant_key]['questionnaireParticipant'] = $applicant->questionnaireParticipant;
                        }
                    }
                }
            }
        }
        //dd($data2);


        return view('statistics.index')->with(['data' => $data, 'data2' => $data2]);
    }
}
