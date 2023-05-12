<x-questionnaire-layout>
    <x-slot name="header">
        <div class="text-right">
            <span id="font-size-up" class="pt-1 pr-1 pl-1 text-xl shadow">A<sup>+</sup></span>
            <span id="font-size-down" class="pt-2 pr-1 pl-1 shadow ">A<sup>-</sup></span>
        </div>
        <div class="text-left">
            <a href="/cancel" class="px-4 py-2 color-blue2 border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                {{__('Tühista')}}
            </a>
        </div>
        <h1 class="text-xl font-semibold text-center mt-3">{{__($page->title)}}</h1>
        <p class="text-justify">{{__($page->description)}}</p>
    </x-slot>
    <livewire:questionnaire.page2 :questions="$questions" :path="$path" :page="$page" :pages="$pages" :applicant="$applicant" :answers="$answers" :answers2="$answers2"/>
</x-questionnaire-layout>
