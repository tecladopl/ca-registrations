<div>
    @if($validations->isEmpty())
        {{ __('No Validations avaliable. Add new below.') }}
    @else
        <div class="p-1 grid grid-cols-5 gap-2">
            <div class="font-bold col-span-1">{{ __('Name') }}</div>
            <div class="font-bold col-span-1">{{ __('Message') }}</div>
            <div class="font-bold col-span-1">{{ __('Questions') }}</div>
            <div class="font-bold col-span-1">{{ __('Answers') }}</div>
            <div class="font-bold col-span-1 flex">{{ __('Actions') }}</div>
            @foreach ($validations as $index => $validation)
                <div class="col-span-1">{{$validation->name}}</div>
                <div class="col-span-1">{{$validation->message}}</div>
                <div class="col-span-1">
                    @if(count($validation->questions)===1)
                        {{$validation->questions->first()->name}}
                    @elseif(count($validation->questions)>1)
                        @foreach($validation->questions as $index => $question)
                            {!! "<b>" . ($index+1) . ")</b> " . $question->name!!}
                            @if($index>0)<br>@endif
                        @endforeach
                    @endif
                </div>
                <div class="col-span-1">
                    @if(count($validation->answers)===1)
                        {{$validation->answers->first()->text}}
                    @elseif(count($validation->answers)>1)
                        @foreach($validation->answers as $index => $answer)
                            {!! "<b>" . ($index+1) . ")</b> " . $answer->text!!}
                            @if($index>0)<br>@endif
                        @endforeach
                    @endif
                </div>
                <div class="col-span-1 flex">
                    @livewire('validation.edit', ['validation' => $validation], key(time().$validation->id))
                    @livewire('validation.delete', ['validation' => $validation],
                    key(time().$validation->id))
                </div>
            @endforeach
        </div>
    @endif
</div>
