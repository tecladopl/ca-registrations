<div class="mb-3">
    @switch($question->question_type->type)
        @case("select")
        <select name="{{$question->input_name}}">
            @break
            @case("text")
            @case("date")
            @case("number")
            @case("email")
            @case("textarea")
            <label class="font-bold" for="{{$question->id}}">{{__($question->label)}}</label>
            @break
            @case("checkbox")
            <div class="mt-4 mb-4">
            <span
                class="checkAll mt-4 mb-4 px-4 py-2 color-blue2 border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                {{__('Vali kõik')}}
            </span>
            </div>
            @case("radio")
            @default
            @endswitch
            @switch($question->question_type->type)
                @case("text")
                <input
                    class="mb-1 mr-1 rounded text-gray-800 border-gray-900 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-50 w-full"
                    type="text" id="{{$question->id}}" name="{{$question->input_name}}"
                    {{$question->options}}
                    required
                    value="@if(isset($question->applicant_answers->where('applicant_id', $applicant->id)->where('question_id', $question->id)->first()->answer)){{$question->applicant_answers->where('applicant_id', $applicant->id)->where('question_id', $question->id)->first()->answer}}@endif">
                <span class="text-sm text-red-600 block">{{ $errors->first($question->input_name) }}</span>
                @break
                @case("date")
                <div class="calendar">
                    <input data-input
                           class="mb-1 mr-1 rounded text-gray-800 border-gray-900 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-50 w-full"
                           type="text" id="{{$question->id}}" name="{{$question->input_name}}"
                           placeholder="DD-MM-YYYY"
                           {{$question->options}}
                           value="@if(isset($question->applicant_answers->where('applicant_id', $applicant->id)->where('question_id', $question->id)->first()->answer)){{$question->applicant_answers->where('applicant_id', $applicant->id)->where('question_id', $question->id)->first()->answer}}@endif">
                    <span class="text-sm text-red-600 block">{{ $errors->first($question->input_name) }}</span>
                    <div class="mt-2">
            <span data-toggle
                  class="calendar-open mt-4 mb-4 px-4 py-2 custom-button border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                Kalendarz
            </span>
                    </div>
                </div>
                @break
                @case("number")

                @break
                @case("email")
                <input
                    class="mb-1 mr-1 rounded text-gray-800 border-gray-900 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-50 w-full"
                    type="email" id="{{$question->id}}" name="{{$question->input_name}}"
                    {{$question->options}}
                    value="@if(isset($question->applicant_answers->where('applicant_id', $applicant->id)->where('question_id', $question->id)->first()->answer)){{$question->applicant_answers->where('applicant_id', $applicant->id)->where('question_id', $question->id)->first()->answer}}@endif">
                <span class="text-sm text-red-600 block">{{ $errors->first($question->input_name) }}</span>
                @break
                @case("textarea")
                <label for="{{$question->id}}"></label>
                @break
                @default
            @endswitch
            @foreach($question->answers as $answer)
                <div class="">
                    @switch($question->question_type->type)

                        @case("checkbox")
                        @if(isset($answer->subtext))
                            <div class="flex">
                                <div class="flex-grow"><label
                                        for="{{$answer->id}}"><b>{{$answer->text}}</b><br><p class="text-justify">{{$answer->subtext}}</p></label></div>
                                <div class="flex-1 text-center m-auto"><input
                                        class="m-5 rounded text-gray-800 border-gray-900 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-50"
                                        type="checkbox" id="{{$answer->id}}" name="{{$question->input_name}}[{{$answer->id}}]"
                                        {{$answer->options}}
                                        @if(!empty($answers->where('answer_id',$answer->id)->last())) checked="checked" @endif
                                        value="{{$answer->id}}"></div>
                            </div>


                        @else
                            <input
                                class="mb-1 mr-1 rounded text-gray-800 border-gray-900 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-50"
                                type="checkbox" id="{{$answer->id}}" name="{{$question->input_name}}[{{$answer->id}}]"
                                {{$answer->options}}
                                @if(!empty($answers->where('answer_id',$answer->id)->last())) checked="checked" @endif
                                value="{{$answer->id}}"><label
                                for="{{$answer->id}}">{{__($answer->text)}}</label>
                        @endif

                        @break
                        @case("radio")
                        <input
                            class="mb-1 mr-1 rounded text-gray-800 border-gray-900 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-50"
                            type="radio" id="{{$answer->id}}" name="{{$question->input_name}}"
                            {{$answer->options}}
                            required
                            @if(!empty($answers->where('answer_id',$answer->id)->last())) checked="checked" @endif
                            value="{{$answer->id}}"><label
                            for="{{$answer->id}}">{{ __($answer->text) }}</label>
                        @break
                        @default
                    @endswitch
                </div>
            @endforeach
            @switch($question->question_type->type)

                @case("radio")
                @case("checkbox")
                <span class="text-sm text-red-600 block">{{ $errors->first($question->input_name) }}</span>

        @break

        @default
    @endswitch

</div>
