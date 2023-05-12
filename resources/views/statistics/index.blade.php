<x-app2-layout>
    <x-slot name="header">
        <div class="flex h-16 justify-between">
            <div
                class="inline-flex items-center flex-none font-semibold text-xl text-gray-800 leading-tight border-r-4 border-indigo-400 pr-10 mr-2">
                <span class="inline-flex items-center">{{ __('Applicants') }}</span>
            </div>
{{--            <div class="flex-grow submenu flex">--}}
{{--                @livewire('questionnaire.submenu')--}}
{{--            </div>--}}
        </div>
    </x-slot>

    <div class="mt-2">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-xl">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        {{ __('Applicants') }}
                    </div>
                    <hr>
                    <table class="table-auto w-max text-center p-3">
                    @foreach($data as $q => $a)
                        <tr><td colspan="2" class="w-1/4 pl-4 pr-4"><b>{{$q}}</b></td></tr>
                        @foreach($a as $answer => $counter)
                            <tr><td class="w-1/4 pl-4 pr-4">{{$answer}}</td><td>{{$counter}}</td></tr>
                        @endforeach
                    @endforeach
                    </table>
                    <hr>
                    <div>
                        <table class="table-auto w-max text-center p-3">
                            <thead class="">
                            <tr>
                                <th class="w-1/4 pl-4 pr-4">No.</th>
                                <th class="w-1/4 pl-4 pr-4">Registration number</th>
                                <th class="w-1/4 pl-4 pr-4">Registration code</th>
                                @foreach($questions as $key => $question)
                                    <th class="w-1/4 pl-4 pr-4">{{$question}}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody class="">
                            @foreach($data2 as $key => $applicant)
                                <tr>
                                    <td class="w-1/4 pl-4 pr-4">{{ $loop->index+1 }}</td>
                                    <td class="w-1/4 pl-4 pr-4">{{$applicant['questionnaireParticipant']->name}}</td>
                                    <td class="w-1/4 pl-4 pr-4">{{$applicant['questionnaireParticipant']->access}}</td>
                                    @foreach($applicant['questions'] as $key => $answer)
                                        <td class="w-1/4 pl-4 pr-4">{{$answer}}</td>
                                    @endforeach
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
{{--                        @livewire('applicant.index', ['questionnaire' => $questionnaire], key(time().$questionnaire->id))--}}

                        <hr>
{{--                        @livewire('questionnaire.add', key(time().$questionnaire->id))--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app2-layout>
