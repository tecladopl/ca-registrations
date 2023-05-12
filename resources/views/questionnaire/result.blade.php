<x-questionnaire-layout>
    <x-slot name="header">
        <div class="text-right">
            <span id="font-size-up" class="pt-1 pr-1 pl-1 text-xl shadow">A<sup>+</sup></span>
            <span id="font-size-down" class="pt-2 pr-1 pl-1 shadow ">A<sup>-</sup></span>
        </div>
        <div class="float-none"></div>
        <div class="text-center">
            <img class="m-auto h-1/4 w-1/4" src="{{asset('/images/index/banner.png')}}"
                 alt="Poznański Panel Obywatelski">
        </div>
    </x-slot>
    <h1 class="text-xl font-semibold mb-8 mt-4 text-center">Wyniki wstępnego losowania</h1>
    @if(!isset($code))
        <h4 class="text-center font-bold pt-2 mt-4">Dziękujemy za zgłoszenia do udziału w Poznańskim Panelu
            Obywatelskim!</h4>
        <h1 class="text-xl font-semibold mb-2 mt-2 text-center">W ostatecznym losowaniu, za pomocą rzutu kostką,
            wylosowany został Skład numer 4!</h1>
        <h4 class="text-center font-bold pt-2 mt-2">Poniżej można znaleźć 6 wstępnie wylosowanych składów ze wszystkich
            zgłoszeń, wraz z listą osób rezerwowych</h4>
        <p class="text-center">Na żywo zostanie wylosowany numer składu, który weźmie udział w Poznańskim Panelu
            Obywatelskim.</p>
        <p class="text-center">Losowanie było przeprowadzane za każdym razem z pełnej puli osób, które zarejestrowały się do udziału w panelu, zatem można się znaleźć w kilku składach jednocześnie.</p>
        <div><br></div>
    @else
        <div class="text-center">
            <a class="link text-center" href="{{url('/poznan/wyniki')}}">Powrót do strony głównej</a>
        </div>
        <br>
        <br>
    @endif
    <div>
        <p>Linki:</p>
        @foreach($data as $result)
            <div>
                <a class="link" href="#{{$result['losowanie']}}">{{$result['name']}}</a>
            </div>
        @endforeach
        <br>
        {{--        <a class="link"  href="#demografia">Rozkład demograficzny Poznania</a>--}}
    </div>

    <div>
        <form method="post" action="/poznan/wyniki">
            @csrf
            <div class="text-center m-5">
                <div class="m-auto text-center">
                    <div><label class="text-center" for="code">Wyszukaj po swoim identyfikatorze:</label></div>
                    <x-jet-input id="code" name="code" type="text" class="mt-1"
                                 :value="old('code', request()->get('code'))"/>
                    <x-jet-input-error for="code" class="mt-2"/>
                </div>
            </div>
            <div class="text-center m-5">
                <div class="mt-5 text-center">
                    <input type="submit" name="send" value="Wyszukaj"
                           class="px-4 py-2 custom-button border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                </div>
            </div>
        </form>
    </div>
    <h1 class="text-xl font-semibold mb-8 mt-4 text-center">Wylosowane składy:</h1>
    @foreach($data as $result)
        <section id="{{$result['losowanie']}}">
            <div>
                <h1 class="text-xl font-semibold mb-8 mt-4 text-center">{{$result['name']}}</h1>
                <h4 class="text-center font-bold pt-2 mt-4">Lista:</h4>
                @foreach($result['osoby'] as $osoba)
                    <span>{{$osoba->kod}}</span>
                @endforeach
                @if(!isset($code))
                    <h4 class="text-center font-bold pt-2 mt-4">Rozkład demograficzny grupy:</h4>
                    @foreach($result['stats'] as $key => $stat)
                        @if($key=='plec')
                            <h4 class="font-bold">Płeć:</h4>
                            @foreach($stat as $key2 => $stat2)
                                <span>{{$stat2->plec}}: <b>{{$stat2->liczba}}  </b></span>
                            @endforeach
                        @endif
                        @if($key=='wiek')
                            <h4 class="font-bold">Grupy wiekowe:</h4>
                            @foreach($stat as $key2 => $stat2)
                                <span>{{$stat2->wiek}}: <b>{{$stat2->liczba}}  </b></span>
                            @endforeach
                        @endif
                        @if($key=='wyksztalcenie')
                            <h4 class="font-bold">Wykształcenie:</h4>
                            @foreach($stat as $key2 => $stat2)
                                <span>{{$stat2->wyksztalcenie}}: <b>{{$stat2->liczba}}  </b></span>
                            @endforeach
                        @endif
                        @if($key=='klimat')
                            <h4 class="font-bold">Stosunek do zmian klimatu:</h4>
                            @foreach($stat as $key2 => $stat2)
                                <span>{{$stat2->klimat}}: <b>{{$stat2->liczba}}  </b></span>
                            @endforeach
                        @endif
                        @if($key=='osiedle')
                            <h4 class="font-bold">Osiedle:</h4>
                            @foreach($stat as $key2 => $stat2)
                                <span>{{$stat2->osiedle}}: <b>{{$stat2->liczba}}  </b></span>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </div>
        </section>
    @endforeach
    {{--    <section id="demografia">--}}
    {{--        <table class="table-auto w-100">--}}
    {{--            <thead>--}}
    {{--            <tr>--}}
    {{--                <th>Grupa wiekowa</th>--}}
    {{--                <th>Płeć</th>--}}
    {{--                <th>Liczba mieszkańców(Dane 2021)</th>--}}
    {{--                <th>Procent</th>--}}
    {{--            </tr>--}}
    {{--            </thead>--}}
    {{--            <tbody>--}}
    {{--            <tr class="w-100">--}}
    {{--                <td rowspan="2">18-24</td>--}}
    {{--                <td>Kobiety</td>--}}
    {{--                <td>13003</td>--}}
    {{--                <td>4%</td>--}}
    {{--            </tr>--}}
    {{--            <tr>--}}
    {{--                <td>Mężczyźni</td>--}}
    {{--                <td>13493</td>--}}
    {{--                <td>4%</td>--}}
    {{--            </tr>--}}
    {{--            </tbody>--}}
    {{--        </table>--}}
    {{--    </section>--}}
    <hr>
    <div class="text-right">
        <br>
        <span class="text-xs mt-4 mr-2">Wykonanie strony: Damian Kozłowski</span>
        <br>
        <span class="text-xs mb-6 mt-5 mr-2">Organizator: Urząd Miasta Poznania</span>
        <br>
    </div>

</x-questionnaire-layout>
