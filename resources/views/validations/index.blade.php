<x-app2-layout>
    <x-slot name="header">
        <div class="flex h-16 justify-between">
            <div
                class="inline-flex items-center flex-none font-semibold text-xl text-gray-800 leading-tight border-r-4 border-indigo-400 pr-10 mr-2">
                <span class="inline-flex items-center">{{ __('Validations') }}</span>
            </div>
            <div class="flex-grow submenu flex">
                @livewire('questionnaire.submenu')
            </div>
        </div>
    </x-slot>
    <div class="mt-2">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-xl">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        {{ __('Validations') }}
                    </div>
                    <div class="mt-4 text-xl mb-2">
                        {{ __('Current Questionnaire: ') }} <b>{{$questionnaire->name}}</b>
                    </div>
                    <hr>
                    <div>
                        @livewire('validation.index', ['questionnaire' => $questionnaire], key(time().$questionnaire->id))
                        <hr>
                        @livewire('validation.add', key(time().$questionnaire->id))
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app2-layout>
