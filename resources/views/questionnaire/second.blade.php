<x-questionnaire-layout>
    <x-slot name="header">
        <div class="text-right">
            <span id="font-size-up" class="pt-1 pr-1 pl-1 text-xl shadow">A<sup>+</sup></span>
            <span id="font-size-down" class="pt-2 pr-1 pl-1 shadow ">A<sup>-</sup></span>
        </div>
        <div class="float-none"></div>
        <div class="text-center">
            <img class="m-auto h-1/4 w-1/4" src="{{asset('/images/index/banner.png')}}" alt="Poznański Panel Obywatelski">
        </div>
    </x-slot>
    <h1 class="text-xl font-semibold mb-8 mt-4 text-center">Głosowanie online</h1>
    <div class="text-center">
        @if($errors->has('duplicate'))
            <span class="text-sm text-red-600">{{ $errors->first('duplicate') }}</span>
        @endif
    </div>

    @if(\Carbon\Carbon::parse($questionnaire->end)->isPast())
        <h4 class="text-center font-bold pt-2 mt-2">Głowanie się zakończyło.</h4>
    @else

        <h4 class="text-center font-bold pt-2 mt-4">Podaj pseudonim, który będzie widoczny w wynikach głosowania. Nie będzie mógł być potem zmieniony.</h4>
        <div class="mt-4">
            <livewire:questionnaire.nickname :path="$path"/>
        </div>
    @endif
        <hr>
        <div class="text-right">
            <br>
            <span class="text-xs mt-4 mr-2">Wykonanie strony: Damian Kozłowski</span>
            <br>
            <span class="text-xs mb-6 mt-5 mr-2">Organizator: Urząd Miasta Poznania</span>
            <br>
        </div>

</x-questionnaire-layout>
