<div>
    <form method="post" action="/{{$questionnaire->path}}/{{(int)($page->page)+1}}" autocomplete="off">
        @csrf
        @foreach($questions as $question)
            <h4 class="font-bold mt-2">{{$question->question}}</h4>
            <p class="text-justify">{!!$question->subtext!!}</p>
            <div>
                @livewire('questionnaire.question', ['question' => $question, 'applicant' => $applicant, 'answers' => $answers],
                key(time().$question->id))
            </div>
        @endforeach
        <div class="text-center m-5">
            <div class="mt-5 text-center">
                @if($page->page>1)
                    <a
                        href="/{{$questionnaire->path}}/{{(int)$page->page-1}}"
                        class="mr-4 px-4 py-2 custom-button border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                        {{__('Back')}}
                    </a>
                @endif
                <input id="clear" type="reset" name="send" value="{{__('Reset')}}"
                        class="cursor-pointer mr-4 px-4 py-2 custom-button border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                <input type="submit" name="send" value="{{__('Next')}}"
                        class="cursor-pointer px-4 py-2 custom-button border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
            </div>
        </div>
    </form>
</div>

