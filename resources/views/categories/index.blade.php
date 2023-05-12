<x-app-layout>
    <x-slot name="header">
        <div class="flex  h-16 justify-between">
            <div
                class="inline-flex items-center flex-none font-semibold text-xl text-gray-800 leading-tight border-r-4 border-indigo-400 pr-10 mr-2">
                <span class="inline-flex items-center">{{ __('Assemblies') }}</span>
            </div>
            <div class="flex-grow submenu flex">
                @livewire('assembly.submenu')
            </div>
        </div>


    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        {{ __('Assembly Criteria') }}
                    </div>
                    @if(isset($assembly))
                    <div class="p-2 mb-6">
                        <p><i>{{__('Current active Assembly: ')}} <b>{{$assembly->name}}</b></i></p>
                    </div>
                    <hr>
                    @endif
                    <div>
                        @livewire('assembly.criteria')
                        @if(isset($assembly))
                        <hr>
                        @livewire('assembly.criteria.add')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
