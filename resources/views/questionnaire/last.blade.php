<x-questionnaire-layout>
    <x-slot name="header">
        <div class="text-right">
            <span id="font-size-up" class="pt-1 pr-1 pl-1 text-xl shadow">A<sup>+</sup></span>
            <span id="font-size-down" class="pt-2 pr-1 pl-1 shadow ">A<sup>-</sup></span>
        </div>
        <h1 class="text-xl font-semiboldtext-center">{{__('Questionnaire summary')}}</h1>
    </x-slot>
    <livewire:questionnaire.last :questionnaire="$questionnaire" :path="$path" :page="$page" :pages="$pages" :applicant="$applicant" :answers2="$answers2" :assembly="$assembly" />
</x-questionnaire-layout>
