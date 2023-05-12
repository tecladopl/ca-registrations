<?php

namespace App\Http\Livewire\QuestionnairePage;

use Livewire\Component;
use App\Models\QuestionnairePage;

class Add extends Component {

    public $modal = false;
    public $page = 1;
    public $title;
    public $description;
    protected $listeners = ['modal'];
    protected $rules = [
        'page' => 'required|numeric|min:1',
        'title' => 'required|string|min:6',
        'description' => 'string|max:500',
    ];

    public function mount() {

    }

    public function modal() {
        $this->modal = true;
    }

    public function render() {
        return view('livewire.questionnaire-page.add');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addQuestionnairePage() {

        $validatedData = $this->validate();
        $validatedData['questionnaire_id'] = auth()->user()->getCurrentQuestionnaire();

        $assembly = QuestionnairePage::create($validatedData);


        $this->emit('questionnairePageAdded');
        $this->modal = false;
        $this->name = null;
        $this->description = null;
    }

}
