<?php

namespace App\Http\Livewire\Questionnaire;

use Livewire\Component;
use App\Http\Requests\QuestionnaireRequest;
use App\Models\Questionnaire;

class Add extends Component {

    public $modal = false;
    public $name;
    public $description;
    public $path;
    public $start;
    public $end;
    protected $listeners = ['modal'];
    protected $rules = [
        // 'name' => 'required|alpha_dash|min:6',
        // 'path' => 'nullable|alpha_dash|max:100|min:3',
        // 'description' => 'nullable|string|max:500',
        // 'start' => 'required|date_format:Y-m-d H:i:s',
        // 'end' => 'required|date_format:Y-m-d H:i:s',
    ];

    public function mount() {

    }

    public function modal() {
        $this->modal = true;
    }

    public function render() {
        return view('livewire.questionnaire.add');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected function rules()
    {
        return (new QuestionnaireRequest())->rules();
    }

    public function addQuestionnaire() {

        $validatedData = $this->validate();
        
        $assembly_id = auth()->user()->getCurrentAssembly();
        
        $validatedData['assembly_id'] = $assembly_id;
        
        $questionnaire = Questionnaire::create($validatedData);
        $questionnaires = Questionnaire::all();

        

        if($questionnaires->count()===1){
            $user = auth()->user();
            $user->setCurrentQuestionnaire($questionnaire->id);
        }

        $this->emit('questionnaireAdded');
        $this->modal = false;
    }

}