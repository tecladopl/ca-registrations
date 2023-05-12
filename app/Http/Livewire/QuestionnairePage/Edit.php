<?php

namespace App\Http\Livewire\QuestionnairePage;

use Livewire\Component;
use App\Models\QuestionnairePage;

class Edit extends Component
{

    public $modalEdit = false;
    public QuestionnairePage $questionnaire_page;
    protected $listeners = ['modalEdit'];
    protected $rules = [
        'questionnaire_page.page' => 'required|numeric|min:1',
        'questionnaire_page.title' => 'required|string|min:6',
        'questionnaire_page.description' => 'sometimes|string|max:500',
    ];

    public function mount() {

    }

    public function render()
    {
        return view('livewire.questionnaire-page.edit');
    }

    public function modalEdit() {
        $this->modalEdit = true;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editQuestionnairePage() {
        $this->validate();

        $this->questionnaire_page->save();

        $this->emit('questionnairePageEdited');
        $this->modalEdit = false;
    }

}
