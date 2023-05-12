<div>
    @if($answers->isEmpty())
        {{ __('No Answers avaliable. Add new below.') }}
    @else
        <div class="p-1 grid grid-cols-6 gap-2">
            <div class="font-bold col-span-1">{{ __('Text') }}</div>
            <div class="font-bold col-span-1">{{ __('Question') }}</div>
            <div class="font-bold col-span-1">{{ __('Order') }}</div>
            <div class="font-bold col-span-1">{{ __('Points') }}</div>
            <div class="font-bold col-span-1">{{ __('Options') }}</div>
            <div class="font-bold col-span-1 flex">{{ __('Actions') }}</div>
            @foreach ($answers as $index => $answer)
                <div class="col-span-1">{{$answer->text}}</div>
                <div class="col-span-1">{{$answer->question->question}}</div>
                <div class="col-span-1">{{$answer->order}}</div>
                <div class="col-span-1">{{$answer->points}}</div>
                <div class="col-span-1">{{$answer->options}}</div>
                <div class="col-span-1 flex">
                    @livewire('answer.edit', ['answer' => $answer], key(time().$answer->id))
                    @livewire('answer.delete', ['answer' => $answer],
                    key(time().$answer->id))
                </div>
            @endforeach
        </div>

    @endif

</div>
