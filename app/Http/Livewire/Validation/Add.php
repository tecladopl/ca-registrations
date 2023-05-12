<?php

namespace App\Http\Livewire\Validation;

use App\Models\Question;
use App\Models\QuestionnairePage;
use Livewire\Component;
use App\Models\Validation;
use App\Models\Answer;

class Add extends Component {

    public $modal = false;
    public $rule;
    public $rule_name;
    public $type;
    public $name;
    public $attach;

    public $message;
    public $answer_ids;
    public $question_ids;
    public $questions;
    public $questionnaire_pages;
    public $answers;
    protected $listeners = ['modal', 'addValidation'];
    protected $rules = [
        'answer_ids' => 'nullable|array',
        'question_ids' => 'nullable|array',
        'attach' => 'nullable|numeric|min:1',
        'message' => 'nullable|string|max:500',
        'rule' => 'nullable|numeric|min:1'
    ];

    public function mount() {
        $this->questionnaire_pages = QuestionnairePage::where('questionnaire_id', auth()->user()->getCurrentQuestionnaire())->get();   
        $this->questions = Question::whereIn('questionnaire_page_id', $this->questionnaire_pages->pluck('id')->toArray())->get();
        $this->answers = Answer::whereIn('question_id', $this->questions->pluck('id')->toArray())->get();
    }

    public function modal() {
        $this->modal = true;
    }

    public function render() {
        return view('livewire.validation.add');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addValidation() {

        $validatedData = $this->validate();
        dd($validatedData);

        $validation = new Validation(['attach' => $validatedData['attach'], 'rule' => $validatedData['rule'], 'message' => $validatedData['message']]);
        $validation->save();
       
 
        if(!empty($validatedData['question_ids'])){
            $questions = Question::whereIn('id',$validatedData['question_ids']);
            foreach($questions as $question) {
                $question->validations()->save($validation);
            }
        }

        if (!empty($validatedData['answer_ids'])) {
            $answers = Answer::whereIn('id',$validatedData['answer_ids']);
            foreach($answers as $answer){
                $answer->validations()->save($validation);
            }
        }

        $this->emit('ValidationAdded');
        $this->modal = false;
    }

}
