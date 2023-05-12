<div>
    @if($questionnaire_pages->isEmpty())
        {{ __('No Questionnaire Pages avaliable. Add new below.') }}
    @else

        <div class="p-1 grid grid-cols-4 gap-2">
            <div class="font-bold col-span-1">{{ __('Page') }}</div>
            <div class="font-bold col-span-1">{{ __('Title') }}</div>
            <div class="font-bold col-span-1">{{ __('Description') }}</div>
            <div class="font-bold col-span-1 flex">{{ __('Actions') }}</div>
            @foreach ($questionnaire_pages as $index => $questionnaire_page)
                <div class="col-span-1">{{$questionnaire_page->page}}</div>
                <div class="col-span-1">{{$questionnaire_page->title}}</div>
                <div class="col-span-1">{{$questionnaire_page->description}}</div>
                <div class="col-span-1 flex">
                    @livewire('questionnaire-page.edit', ['questionnaire_page' => $questionnaire_page], key(time().$questionnaire_page->id))
                    @livewire('questionnaire-page.delete', ['questionnaire_page' => $questionnaire_page],
                    key(time().$questionnaire_page->id))
                </div>
            @endforeach
        </div>

    @endif

</div>
