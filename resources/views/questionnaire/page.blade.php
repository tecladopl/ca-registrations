<x-questionnaire-layout>
    <x-slot name="header">
        <div class="text-right">
            <span id="font-size-up" class="pt-1 pr-1 pl-1 text-xl shadow">A<sup>+</sup></span>
            <span id="font-size-down" class="pt-2 pr-1 pl-1 shadow ">A<sup>-</sup></span>
        </div>
        <div class="text-left">
            <a href="/{{$questionnaire->path}}/cancel" class="px-4 py-2 custom-button border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                {{__('Cancel')}}
            </a>
        </div>
        <h1 class="text-xl font-semiboldtext-center">{{$page->title}}</h1>
        <p class="text-justify">{{$page->description}}</p>
    </x-slot>
    <livewire:questionnaire.page :questionnaire="$questionnaire" :questions="$questions" :page="$page" :applicant="$applicant" :answers="$answers" :pages="$pages"/>
</x-questionnaire-layout>
