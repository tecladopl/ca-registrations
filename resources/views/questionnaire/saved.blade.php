<x-questionnaire-layout>
    <x-slot name="header">
        <div class="text-right">
            <span id="font-size-up" class="pt-1 pr-1 pl-1 text-xl shadow">A<sup>+</sup></span>
            <span id="font-size-down" class="pt-2 pr-1 pl-1 shadow ">A<sup>-</sup></span>
        </div>
        <h1 class="text-xl font-semiboldtext-center">{{__('Questionnaire has been saved')}}</h1>

    </x-slot>
    <div>
        <p class="text-justify">{{__('Thank you for your participation!')}}</p>
        @if(!empty($questionnaire->last_page))
            {!!$questionnaire->last_page!!}
        @endif
        <h4>{{__('Your identificator for draw is: ')}}</h4>
        <p class="text-center font-bold text-xl">{{$applicant->identity_string}}</p>
        {{-- <p class="text-justify">{{__('If you provided an email address, identificator has been attached to it.')}}</p> --}}
    </div>
    <div class="text-center block mt-4">
        <a
            href="/{{$questionnaire->path}}"
            class="link">
            {{__('Get back to the beginning')}}
        </a>
    </div>
</x-questionnaire-layout>
