<?php

namespace App\Http\Livewire\Questionnaire;

use Livewire\Component;
use App\Models\QuestionnaireParticipant;
use Illuminate\Http\Request;
use App\Models\Questionnaire;

class Access extends Component
{

    public $code;
    public Questionnaire $questionnaire;
    protected $rules = [
        'code' => 'required|string|alpha_num'
    ];

    public function render()
    {
        return view('livewire.questionnaire.access');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function access(Request $request){
        $validatedData = $this->validate();
        $questionnaire = Questionnaire::getByPath($request);
        if(empty($questionnaire)) {
            throw new \Exception(__('Questionnaire does not exists'));   
        }
        $code = strtolower($validatedData['code']);
        $questionnaireParticipant = QuestionnaireParticipant::where('access_code', $code)->where('questionnaire_id', $questionnaire->id)->first();
        if(!empty($questionnaireParticipant)){
            $request->session()->put('access_code', $code);
            $this->redirect($questionnaire->path . '/1');
        }else{
            $errors = $this->getErrorBag();
            $errors->add('access-error', __('Provided code is incorrect'));
        }

    }
}
