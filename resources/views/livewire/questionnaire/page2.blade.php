<div>
    @if($page->page>=$pages)
        <div>
            <h1 class="text-xl font-semibold text-center">{{__('Teie valik on:')}}</h1>
            @foreach($answers2 as $key => $answer2)

                @if(!$loop->first)
                @if($answers2[$key-1]->question()->first()->questionnaire_page->id!=$answer2->question()->first()->questionnaire_page->id)
{{--                        <h4 class="font-bold mt-2">{!! $answer2->question()->first()->questionnaire_page->title !!}</h4>--}}
{{--                    <h4 class="font-bold mt-2">{!! $answer2->question()->first()->questionnaire_page->title !!}</h4>--}}

                @endif
                    <b>{!! __($answer2->question()->first()->question) !!}</b>
                @if($answer2->answers()->count()>=1)
                        <p>{!! __($answer2->answers()->first()->text) !!}</p>
                    @else
                        {{--                    <h4 class="font-bold mt-2">{!! $answer2->question()->first()->questionnaire_page->title !!}</h4>--}}
                        <p>{!! __($answer2->answer_text) !!}</p>
                    @endif


            @endforeach
        </div>
        <form method="post" action="/last" autocomplete="off">
            @else
                <form method="post" action="/{{(int)$page->page}}" autocomplete="off">
                    @endif
                    @csrf
                    @foreach($questions as $question)
                        <h4 class="mt-2">{{ trans($question->question) }}</h4>
                        <p class="text-justify">{!!__($question->subtext)!!}</p>
                        @if($page->page==4)
                            <h2>{{__('TEAVE ISIKUANDMETE TÖÖTLEMISE KOHTA')}}</h2>
                            <p>{{__('Isikuandmete vastutav töötleja on Eestimaa Looduse Fondi (ELF).')}}</p>
                        <div class="ml-4">
                            <ol class="list-decimal3 ml-4">
                                <li>{{__('ELF austab igaühe privaatsust ja õigust isikuandmete kaitsele ning ankeediga kogutud andmeid töödeldakse vaid avalikes huvides ja kliimakogu vormis toimuva avaliku konsultatsiooni korraldamiseks.')}}</li>
                                <li>{{__('Isikuandmete esitamine ankeedis on vabatahtlik. Esitatud isikuandmeid kasutame selleks, et loosida vabatahtlike huviliste seast esinduslik noorte kogu ja osalejatega suhelda.')}}</li>
                                <li>{{__('Hoiame Teie andmeid turvaliselt ning kaitseme neid kadumise, kuritarvitamise ja muutmise eest: ELF ei väljasta isikuandmeid kolmandatele osapooltele. Me ei kasuta, töötle ega edasta Teie isikuandmeid moel, mis ületaks selleks seatud norme või Teie poolt andmete kasutamise nõusolekuga kehtestatud piiranguid.')}}</li>
                                <li>{{__('Kui andmete kogumise eesmärk (osalejate värbamine, loosimine, kontakti hoidmine) on täidetud, kustutame need hiljemalt 7 päeval peale viimase kohtumise toimumist.')}}</li>
                                <li>{{__('Kliimakogu kohtumiste ajal võime teha fotosid, mis avaldatakse avalikes kliimakogu kajastavates kanalites.')}}</li>
                                <li>{{__('Teil on õigus teada saada, millised Teie andmed on Ida-Viru noorte kliimakogu korraldamiseks talletatud ning neid soovi korral parandada, kustutada või nende kasutamine peatada. Selleks võite saata meile e-kirja aadressile maris.jogeva@elfond.ee või helistada telefonil +372 53421726 (Ida-Viru noorte kliimakogu projektijuht).')}}</li>
                            </ol>
                        </div>

                        @endif
                        <div>
                            @livewire('questionnaire.question', ['question' => $question, 'applicant' => $applicant,
                            'answers' => $answers],
                            key(time().$question->id))
                        </div>
                    @endforeach
                    <div class="text-center m-5">
                        <div class="mt-5 text-center">
                            @if($page->page>1)
                                <a
                                    href="/{{(int)$page->page-1}}"
                                    class="mr-4 px-4 py-2 color-blue2 border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                                    {{__('Tagasi')}}
                                </a>
                            @endif
                            @if(!($page->page>=$pages))
                                <input id="clear" type="reset" name="send" value="{{__('Lähtesta')}}"
                                       class="cursor-pointer mr-4 px-4 py-2 color-blue2 border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                            @endif
                            <input type="submit" name="send"
                                   value="@if($page->page>=$pages) {{__('Registreeri')}} @else {{__('Järgmine')}} @endif"
                                   class="cursor-pointer px-4 py-2 color-blue2 border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                        </div>
                    </div>
                </form>
</div>
