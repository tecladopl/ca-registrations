<div>
    @if($questions->isEmpty())
        {{ __('No Questions avaliable. Add new below.') }}
    @else
{{--    {{dd($questions)}}--}}
        <div class="p-1 grid grid-cols-7 gap-2">
            <div class="font-bold col-span-1">{{ __('Name') }}</div>
            <div class="font-bold col-span-1">{{ __('Subtext') }}</div>
            <div class="font-bold col-span-1">{{ __('Page\'s name') }}</div>
            <div class="font-bold col-span-1">{{ __('Type') }}</div>
            <div class="font-bold col-span-1">{{ __('Label') }}</div>
            <div class="font-bold col-span-1">{{ __('Order') }}</div>
            <div class="font-bold col-span-1 flex">{{ __('Actions') }}</div>
            @foreach ($questions as $index => $question)
                <div class="col-span-1">{{$question->name}}</div>
                <div class="col-span-1">{{$question->subtext}}</div>
                <div class="col-span-1">{{$question->questionnaire_page->title}}</div>
                <div class="col-span-1">{{$question->question_type->type}}</div>
                <div class="col-span-1">{{$question->label}}</div>
                <div class="col-span-1">{{$question->order}}</div>
                <div class="col-span-1 flex">
                    @livewire('question.edit', ['question' => $question], key(time().$question->id))
                    @livewire('question.delete', ['question' => $question, 'questionnaire_page' => $question->questionnaire_page],
                    key(time().$question->id))
                </div>
            @endforeach
        </div>
    @endif
</div>
