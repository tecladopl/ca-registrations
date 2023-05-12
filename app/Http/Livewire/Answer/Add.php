<?php

namespace App\Http\Livewire\Answer;

use App\Models\Question;
use App\Models\QuestionnairePage;
use Livewire\Component;
use App\Models\Answer;

class Add extends Component {

    public $modal = false;
    public $page = 1;
    public $text;
    public $points;
    public $subtext;
    public $question_id;
    public $questions;

    public $questionnaire_pages;
    public $order;
    protected $listeners = ['modal'];
    protected $rules = [
        'order' => 'sometimes|numeric|min:1',
        'question_id' => 'required|numeric|min:1',
        'points' => 'numeric',
        'text' => 'string|min:6',
        'subtext' => 'string|max:500',
    ];

    public function mount() {
        $this->questionnaire_pages = QuestionnairePage::where('questionnaire_id', auth()->user()->getCurrentQuestionnaire())->get();
        $this->questions = Question::whereIn('questionnaire_page_id', $this->questionnaire_pages->pluck('id')->toArray())->get();
    }

    public function modal() {
        $this->modal = true;
    }

    public function render() {
        return view('livewire.answer.add');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addAnswer() {

        $validatedData = $this->validate();
        $validatedData['questionnaire_id'] = auth()->user()->getCurrentQuestionnaire();

        $anwer = Answer::create($validatedData);


        $this->emit('AnswerAdded');
        $this->modal = false;
    }

}
