<?php

namespace App\Http\Livewire\QuestionnairePage;

use Livewire\Component;
use App\Models\QuestionnairePage;

class Index extends Component {

    public $questionnaire_pages;
    protected $listeners = [
        'questionnairePageAdded' => '$refresh',
        'questionnairePageEdited' => '$refresh',
        'questionnairePageDeleted' => '$refresh',
        'questionnairePageActivated' => '$refresh',
    ];
    public $current_questionnaire_id;


    public function mount() {

    }

    public function render() {
        $this->current_questionnaire_id = auth()->user()->current_questionnaire_id;
        $questionnaire_pages = QuestionnairePage::where('questionnaire_id', $this->current_questionnaire_id)->get();
        $this->questionnaire_pages = $questionnaire_pages;
        return view('livewire.questionnaire-page.index');
    }



}
