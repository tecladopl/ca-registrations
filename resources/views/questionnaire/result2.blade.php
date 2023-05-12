<x-questionnaire-layout2>
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
    <h1 class="text-xl font-semibold mb-8 mt-4 text-center">Wyniki głosowania</h1>
    <h1 class="text-xl font-semibold mb-8 mt-8 text-center">Podsumowanie:</h1>
    <div>
        <table class="text-left w-full mb-4 pt-2 border-collapse border">
            <thead class="color-blue text-white w-full">
            <tr class="w-full mb-4">
                <th class="border p-1">LP</th>
                <th class="border p-1">Strona</th>
                <th class="border p-1">Nr</th>
                <th class="border p-1">Rekomendacja</th>
                <th class="border p-1">Suma punktów</th>
                <th class="border p-1">Liczba głosów</th>
                <th class="border p-1">Głosów "nie dotyczy"</th>
                <th class="border p-1">Głosów popierających</th>
                <th class="border p-1">Poparcie [%]</th>
                <th class="border p-1">Średnia punktów</th>
            </tr>
            </thead>
            <tbody class="bg-grey-light items-right w-full">
            @foreach($data2 as $key => $datum)
                <tr class="w-full">
                    <td class="border p-1">{!! $key+1 !!}</td>
                    <td class="border p-1">{!! $datum->page !!}</td>
                    <td class="border p-1">{!! $datum->qorder !!}</td>
                    <td class="border p-1">{!! $datum->prop !!}</td>
                    <td class="border p-1">{{$datum->sum_pts}}</td>
                    <td class="border p-1">{{$datum->glos}}</td>
                    <td class="border p-1">{{$datum->nd}}</td>
                    <td class="border p-1">{{$datum->glos_pop}}</td>
                    <td class="border p-1">{{$datum->pop*100}}%</td>
                    <td class="border p-1">{{$datum->sred}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>

    </div>
    <h1 class="text-xl font-semibold mb-8 mt-4 text-center">Głosy:</h1>
    @foreach($data as $datum)
        <div>
            <table class="text-left w-full mb-4 pt-2">
                <thead class="color-blue flex text-white w-full">
                <tr class="flex w-full mb-4">
                    <th class="w-1/5">Pseudonim</th>
                    @foreach(head($datum) as $question => $answer)
                        <th class="w-1/5">{!! $question !!}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody class="bg-grey-light flex flex-col items-center justify-between overflow-y-scroll w-full"
                       style="height: 60vh;">
                @foreach($datum as $nickname => $qa)
                    <tr class="flex w-full">
                        <td class="w-1/5">{{$nickname}}</td>
                        @foreach($qa as $question => $answer)
                        <td class="w-1/5">{!! $answer !!}</td>
                        @endforeach
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    @endforeach


    <hr>
    <div class="text-right">
        <br>
        <span class="text-xs mt-4 mr-2">Wykonanie strony: Damian Kozłowski</span>
        <br>
        <span class="text-xs mb-6 mt-5 mr-2">Organizator: Urząd Miasta Poznania</span>
        <br>
    </div>

</x-questionnaire-layout2>
