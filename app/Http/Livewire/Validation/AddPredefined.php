<?php

namespace App\Http\Livewire\Validation;

use App\Models\Validation;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\QuestionnairePage;
use App\Models\Question;

class AddPredefined extends Component
{

    public $predefined_answers_id;
    public $modalAddPredefined = false;
    public $question_id;
    public $questions;

    protected $rules = [
        'question_id' => 'required|numeric|min:1',
    ];

    public function mount()
    {
        $this->questionnaire_pages = QuestionnairePage::where('questionnaire_id', auth()->user()->getCurrentQuestionnaire())->get();
        $this->questions = Question::whereIn('questionnaire_page_id', $this->questionnaire_pages->pluck('id')->toArray())->get();
    }

    public function modalAddPredefined()
    {
        $this->modalAddPredefined = true;
    }

    public function render()
    {
        return view('livewire.answer.add-predefined');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addPredefinedValidations()
    {
        $validatedData = $this->validate();

        switch ($this->predefined_answers_id) {
            case 1:
                $answer = new Validation();
                $answer->question_id = $this->question_id;
                $answer->text = "1) Zdecydowanie tak";
                $answer->order = 1;
                $answer->points = 3;
                $answer->options = "";
                $answer->created_at = Carbon::now();
                $answer->updated_at = Carbon::now();
                $answer->save();
                $answer = new Validation();
                $answer->question_id = $this->question_id;
                $answer->text = "2) Tak";
                $answer->order = 2;
                $answer->points = 2;
                $answer->options = "";
                $answer->created_at = Carbon::now();
                $answer->updated_at = Carbon::now();
                $answer->save();
                $answer = new Validation();
                $answer->question_id = $this->question_id;
                $answer->text = "3) Raczej tak";
                $answer->order = 3;
                $answer->points = 1;
                $answer->options = "";
                $answer->created_at = Carbon::now();
                $answer->updated_at = Carbon::now();
                $answer->save();
                break;
            case 2:
                $answer = new Validation();
                $answer->question_id = $this->question_id;
                $answer->text = "1) Zdecydowanie się zgadzam";
                $answer->order = 1;
                $answer->points = 3;
                $answer->options = "";
                $answer->created_at = Carbon::now();
                $answer->updated_at = Carbon::now();
                $answer->save();
                $answer = new Validation();
                $answer->question_id = $this->question_id;
                $answer->text = "2) Zgadzam się";
                $answer->order = 2;
                $answer->points = 2;
                $answer->options = "";
                $answer->created_at = Carbon::now();
                $answer->updated_at = Carbon::now();
                $answer->save();
                $answer = new Validation();
                $answer->question_id = $this->question_id;
                $answer->text = "3) Zgadzam się, choć mam pewne wątpliwości lub zastrzeżenia";
                $answer->order = 3;
                $answer->points = 1;
                $answer->options = "";
                $answer->created_at = Carbon::now();
                $answer->updated_at = Carbon::now();
                $answer->save();
                $answer = new Validation();
                $answer->question_id = $this->question_id;
                $answer->text = "4) Mam wiele wątpliwości";
                $answer->order = 4;
                $answer->points = 0;
                $answer->options = "";
                $answer->created_at = Carbon::now();
                $answer->updated_at = Carbon::now();
                $answer->save();
                $answer = new Validation();
                $answer->question_id = $this->question_id;
                $answer->text = "5) Raczej się nie zgadzam";
                $answer->order = 5;
                $answer->points = 0;
                $answer->options = "";
                $answer->created_at = Carbon::now();
                $answer->updated_at = Carbon::now();
                $answer->save();
                $answer = new Validation();
                $answer->question_id = $this->question_id;
                $answer->text = "6) Nie zgadzam się";
                $answer->order = 6;
                $answer->points = 0;
                $answer->options = "";
                $answer->created_at = Carbon::now();
                $answer->updated_at = Carbon::now();
                $answer->save();
                $answer = new Validation();
                $answer->question_id = $this->question_id;
                $answer->text = "7) Zdecydowanie się nie zgadzam";
                $answer->order = 7;
                $answer->points = 0;
                $answer->options = "";
                $answer->created_at = Carbon::now();
                $answer->updated_at = Carbon::now();
                $answer->save();
                break;
            default:
                break;
        }

        $this->emit('predefinedValidationAdded');
        $this->modalAddPredefined = false;
    }
}
