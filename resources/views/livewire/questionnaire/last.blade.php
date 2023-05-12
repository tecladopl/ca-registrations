
<div>
        <div>
            <h1 class="text-xl font-semibold text-center">{{ __('Your answers:') }}</h1>
            
            @foreach($answers2 as $key => $answer2)
                    @if ($loop->first)
                        <h4 class="font-bold mb-4">{!! $answer2->question->questionnaire_page->title !!}</h4>
                    @endif

                    <b>{!! __($answer2->question->question) !!}</b>
                    
                    @if(!empty($answer2->answer_id))
                        <p>{!! __($answer2->answers) !!}</p>
                    @else
                        <p>{!! __($answer2->answer_text) !!}</p>
                    @endif


            @endforeach
        </div>
        {{-- <div>
            {!! $questionnaire->last_page !!}
        </div> --}}
        <form method="post" action="/{{$questionnaire->path}}/last" autocomplete="off" wire:submit.prevent="submit">
            @csrf
            {!! $questionnaire->last !!}
            <div class="mt-3 mb-3">
                <h4 class="text-center font-bold">{{__('Contact information')}}
                <x-jet-label for="email" value="{{ __('Contact e-mail address*') }}" />
                            <x-jet-input id="email" type="text" x-ref="email" class="mt-1 block w-full" wire:model="email"
                                wire:model.defer="email" autocomplete="email" />
                            <x-jet-input-error for="email" class="mt-2" />
                            <p class="text-sm text-left">{{__('*if you do not possess private email address, please provide an address you will be able to access easily through a friend, colleague or family member.')}}</p>
               <x-jet-label for="phone" value="{{ __('Phone number') }}" />
                            <x-jet-input id="phone" type="text" x-ref="phone" class="mt-1 block w-full" wire:model="phone"
                                wire:model.defer="phone" autocomplete="path" />
                            <x-jet-input-error for="phone" class="mt-2" />
                <h4 class="text-center font-bold">{{__('Personal data processing')}} 
    <p class="text-sm text-left">{{__('Personal data administrator is: ')}}{{$assembly->promoter}}. {{__("All the personal data will be used only in Citizen's Assembly organisation process purposes.")}}</p>
    <p class="text-xs text-left">{{__('Personal data processing includes collection, recording, organisation, structuring, storage, adaptation or alteration, retrieval, consultation, use, disclosure by transmission, dissemination or otherwise making available, alignment or combination, restriction, erasure or destruction of personal data. Data processing is partially automated. All data is protected against unauthorised access and processed only by authorised entities.')}}</p>
    <div class="text-left">
        <input
    class="mb-1 mr-1  rounded text-gray-800 border-gray-900 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-50"
    type="checkbox" id="declaration_of_data_compliance_with_the_truth" name="declaration_of_data_compliance_with_the_truth"
    wire:model="declaration_of_data_compliance_with_the_truth"
                                wire:model.defer="declaration_of_data_compliance_with_the_truth"
    value="1">
    <label class="inline"
    for="declaration_of_data_compliance_with_the_truth">{{__((empty($questionnaire->declaration_of_data_compliance_with_the_truth) ? 'I declare that the data provided by me in the form is correct and true.' : $questionnaire->declaration_of_data_compliance_with_the_truth))}}</label>
    <x-jet-input-error for="declaration_of_data_compliance_with_the_truth" class="mt-2" />
    </div>
    <div class="text-left">
        <input
    class="mb-1 mr-1  rounded text-gray-800 border-gray-900 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-50"
    type="checkbox" id="consent_to_the_processing_of_personal_data" name="consent_to_the_processing_of_personal_data"
    wire:model="consent_to_the_processing_of_personal_data"
                                wire:model.defer="consent_to_the_processing_of_personal_data"
    value="1">
    <label class="inline"
    for="consent_to_the_processing_of_personal_data">{{__((empty($questionnaire->consent_to_the_processing_of_personal_data) ? 'I consent to the processing of my personal data for the purposes of the CA organization GDPR.' : $questionnaire->consent_to_the_processing_of_personal_data))}}</label>
    <x-jet-input-error for="consent_to_the_processing_of_personal_data" class="mt-2" />
    </div>
            </div>
            
            <div class="text-center m-5">
                <div class="mt-5 text-center">
                    <a
                        href="/{{$questionnaire->path}}/{{(int)$pages}}"
                        class="mr-4 px-4 py-2 color-blue2 border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                        {{__('Back')}}
                    </a>
                    <input type="submit" name="send" wire:click="$emit('lastSubmit')"
                                value="{{__('Submit')}}"
                                class="cursor-pointer px-4 py-2 color-blue2 border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                </div>
            </div>
        </form>
</div>
