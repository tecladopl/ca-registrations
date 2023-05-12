<x-questionnaire-layout>
    <x-slot name="header">
        <div class="text-right">
            <span id="font-size-up" class="pt-1 pr-1 pl-1 text-xl shadow">A<sup>+</sup></span>
            <span id="font-size-down" class="pt-2 pr-1 pl-1 shadow ">A<sup>-</sup></span>
        </div>
        <div class="float-none"></div>
        <div class="text-center">
            <img class="m-auto h-1/4 w-1/4" src="{{asset('/images/index/'.$questionnaire->path.'.png')}}" alt="{{__("Citizen's assembly")}}">
        </div>
    </x-slot>
    <h1 class="text-xl2 font-semibold mb-8 mt-4 text-center">{{$questionnaire->name}}</h1>
    <h1 class="text-md font-semibold mb-8 mt-4 text-center">{{$questionnaire->description}}</h1>
    <div class="text-center">
        @if($errors->has('duplicate'))
            <span class="text-sm text-red-600">{{ $errors->first('duplicate') }}</span>
        @endif
    </div>
    <div>
         @if(!empty($questionnaire->first_page))
            {!!$questionnaire->first_page!!}
        @else
             
        @endif     
    </div>
    @if(\Carbon\Carbon::parse($questionnaire->end)->isPast())
    <div>
        @if(!empty($questionnaire->is_past_msg))
            {!!$questionnaire->is_past_msg!!}
        @else
            <p>{{__('Unfortunately, the questionnaire is now closed.')}}</p>
        @endif     
    </div>   
    @elseif(\Carbon\Carbon::parse($questionnaire->start)->isFuture())
    <div>
        @if(!empty($questionnaire->is_future_msg))
            {!!$questionnaire->is_future_msg!!}
        @else
            <p>{{__('Unfortunately, the questionnaire has not yet started.')}}</p>
        @endif     
    </div>   
    @else
       
        <h4 class="text-center font-bold pt-2 mt-4">{{__('To access the questionnaire, please enter the access code which is included in the invitation letter')}}</h4>
        <div class="mt-4">
            @livewire('questionnaire.access', ['questionnaire' => $questionnaire],
                            key(time().$questionnaire->id))
        </div>
    @endif
        <hr>
        <div class="text-right">
            <br>
            <span class="text-xs mb-6 mt-5 mr-2">{{__('Organiser')}}: {{$assembly->promoter}}</span>
            <br>
        </div>
    
</x-questionnaire-layout>
