<?php

namespace App\Http\Livewire\Questionnaire;

use Livewire\Component;
use App\Models\Questionnaire;

class Index extends Component
{

    public $questionnaires;
    public $questionnaire;
    public $current_questionnaire_id;
    protected $listeners = [
        'questionnaireAdded' => '$refresh',
        'questionnaireEdited' => '$refresh',
        'questionnaireDeleted' => '$refresh',
        'questionnaireActivated' => '$refresh',
    ];

    public function mount()
    {

    }

    public function updated()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->questionnaire = Questionnaire::where('id', auth()->user()->getCurrentQuestionnaire())->first();
        $questionnaires = Questionnaire::all();
        $this->questionnaires = $questionnaires;
        $this->current_questionnaire_id = auth()->user()->getCurrentQuestionnaire();
        return view('livewire.questionnaire.index');
    }


}
