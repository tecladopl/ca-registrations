<?php

namespace App\Http\Livewire\QuestionnairePage;

use Livewire\QuestionnairePage;
use Livewire\Component;

class Delete extends Component
{

    public $modalDelete = false;
    public \App\Models\QuestionnairePage $questionnaire_page;
    protected $listeners = ['modalDelete'];

    public function render()
    {
        return view('livewire.questionnaire-page.delete');
    }

    public function modalDelete() {
        $this->modalDelete = true;
    }

    public function deleteAssembly() {
        $this->questionnaire_page->delete();
        $this->emit('questionnairePageDeleted');
        $this->modalDelete = false;
    }
}
