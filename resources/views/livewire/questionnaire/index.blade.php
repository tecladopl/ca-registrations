<div>
    <div class="mt-4 text-xl mb-2">
        @if(!empty($questionnaire))
        {{ __('Current Questionnaire: ') }} <b>{{$questionnaire->name}}</b>
        @endif
    </div>
    @if($questionnaires->isEmpty())
    {{ __('No Questionnaires avaliable. Add new below.') }}
    @else
    <div class="p-1 grid grid-cols-6 gap-2">
        <div class="font-bold col-span-1">{{ __('Name') }}</div>
        <div class="font-bold col-span-1">{{ __('Description') }}</div>
        <div class="font-bold col-span-1">{{ __('Path') }}</div>
        <div class="font-bold col-span-1">{{ __('Starts') }}</div>
        <div class="font-bold col-span-1">{{ __('Ends') }}</div>
        <div class="font-bold col-span-1 flex">{{ __('Actions') }}</div>
        @foreach ($questionnaires as $index => $q)
        <div class="col-span-1">{{$q->name}}</div>
        <div class="col-span-1">{{$q->description}}</div>
        <div class="col-span-1">{{config('app.url') . '/'}}{{$q->path}}</div>
        <div class="col-span-1">{{$q->start}}</div>
        <div class="col-span-1">{{$q->end}}</div>
        <div class="col-span-1 flex">
            @livewire('questionnaire.edit', ['questionnaire' => $q], key('edit'.$index))
            @livewire('questionnaire.delete', ['questionnaire' => $q], key('delete'.$index))
            @if($current_questionnaire_id != $q->id) @livewire('questionnaire.activate', ['questionnaire' => $q],
            key('activate'.$index)) @endif
        </div>
        @endforeach
    </div>
    @endif
</div>