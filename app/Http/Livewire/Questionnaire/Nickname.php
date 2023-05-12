<?php

namespace App\Http\Livewire\Questionnaire;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Livewire\Component;

class Nickname extends Component
{

    public $nickname;
    public $path;
    private Request $request;
    protected $rules;


    public function mount(Request $request)
    {
        $rule = new \App\Rules\Nickname($request);
        $this->rules = [
            'nickname' => ['required', 'string', 'alpha', $rule],
        ];
    }

    public function render(Request $request)
    {

        return view('livewire.questionnaire.nickname');
    }



    public function nickname(Request $request){
        $rule = new \App\Rules\Nickname($request);
        $this->rules = [
            'nickname' => ['required', 'string', 'alpha', $rule],
        ];
        $validatedData = $this->validate();
        $nickname = strtolower($validatedData['nickname']);

    }
}
