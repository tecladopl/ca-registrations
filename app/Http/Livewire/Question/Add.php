<?php

namespace App\Http\Livewire\Question;

use App\Models\Question;
use Livewire\Component;
use App\Models\QuestionnairePage;
use Dirape\Token\Token;

class Add extends Component {

    public $modal = false;
    public $questionnaire_page_id;
    public $name;
    public $points;
    public $question;
    public $input_name;
    public $subtext;
    public $questionnaire_pages;
    public $question_type_id;
    public $options;
    public $label;
    public $order;
    protected $listeners = ['modal'];
    protected $rules = [
        'questionnaire_page_id' => 'required|numeric|min:1',
        'name' => 'required|string|min:3',
        'subtext' => 'string|max:500',
        'question_type_id' => 'required',
        'order' => 'required|numeric|min:1',
    ];

    public function mount() {
        $this->questionnaire_pages = QuestionnairePage::where('questionnaire_id', auth()->user()->getCurrentQuestionnaire())->get();
    }

    public function modal() {
        $this->modal = true;
    }

    public function render() {
        return view('livewire.question.add');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

    }

    public function addQuestion() {

        $validatedData = $this->validate();
        $validatedData['question'] = $validatedData['name'];
        $validatedData['input_name'] = (new Token())->unique('questions', 'input_name', 8);

        Question::create($validatedData);


        $this->emit('questionAdded');
        $this->modal = false;
        $this->name = null;
        $this->subtext = null;
    }

}
