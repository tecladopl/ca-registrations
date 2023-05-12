<x-questionnaire-layout>
    <x-slot name="header">
        <div class="text-right">
            <span id="font-size-up" class="pt-1 pr-1 pl-1 text-xl shadow">A<sup>+</sup></span>
            <span id="font-size-down" class="pt-2 pr-1 pl-1 shadow ">A<sup>-</sup></span>
        </div>
        <h1 class="text-xl font-semiboldtext-center">{{__($page->title)}}</h1>
        <p class="text-justify">{{__($page->description)}}</p>
    </x-slot>
    <livewire:questionnaire.page :questions="$questions" :page="$page" :applicant="$applicant"/>
</x-questionnaire-layout>
