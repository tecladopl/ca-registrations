<x-questionnaire-layout>
    <x-slot name="header">
        <div class="text-right">
            <span id="font-size-up" class="pt-1 pr-1 pl-1 text-xl shadow">A<sup>+</sup></span>
            <span id="font-size-down" class="pt-2 pr-1 pl-1 shadow ">A<sup>-</sup></span>
        </div>
        <div class="float-none"></div>
        <div class="text-center">
            <a target="_blank" href="https://www.kliimamuutused.ee/kliimakogu"><img class="m-auto"
                                                                                    src="{{asset('/images/index/banner.png')}}"
                                                                                    alt="{{__('Kliimakogu')}}"></a>
        </div>
    </x-slot>

    <h1 class="text-xl font-semibold mb-8 mt-4 text-center">{{__('Registreerimine')}}</h1>
    <div class="text-center">
        @if($errors->has('duplicate'))
            <span class="text-sm text-red-600">{{ $errors->first('duplicate') }}</span>
        @endif
    </div>
    <div class="text-center">
        <p>Sellel lehel on Sul võimalik registreerida oma huvi kliimakogus osalemiseks. Saad seda teha, kui oled saanud
            kutse ja salasõna. Ida-Viru noorte kliimakogu kohta saad rohkem lugeda lehelt <a target="_blank"
                                                                                             href="https://www.kliimamuutused.ee/kliimakogu">www.kliimamuutused.ee/kliimakogu</a>
        </p>
        <br>
        <p>На этой странице вы можете зарегистрировать свой интерес к участию в климатическом собрании. Это можно
            сделать при условии, что у вас есть приглашение или пароль. О молодежном климатическом собрании Ида-Вирумаа
            можете узнать больше на странице <a target="_blank"
                                                href="https://www.kliimamuutused.ee/kliimakogu">www.kliimamuutused.ee/kliimakogu</a>
        </p>
    </div>

    <hr>
    <br>
    <div class="text-center">
        <a class="px-4 py-2 color-blue2 border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer"
           href="/setLocale?locale=et">{{__('Eesti')}}</a>
        <a class="px-4 py-2 color-blue2 border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer"
           href="/setLocale?locale=ru">{{__('Русский')}}</a>
    </div>
    @if(\Carbon\Carbon::parse($questionnaire->end)->isPast() || \Carbon\Carbon::parse($questionnaire->start)->isFuture() || empty($questionnaire))
        <h4 class="text-center font-bold pt-2 mt-2 mb-4 pb-4">{{__('Registreerimine on lõppenud')}}</h4>
    @else

        <h4 class="text-center font-bold pt-2 mt-4">{{__('Logimise')}}</h4>
        <div class="mt-4">
            <livewire:questionnaire.access2 :path="$path"/>
        </div>
    @endif
    <hr>
    {{--        <div class="text-right">--}}
    {{--            <br>--}}
    {{--            <span class="text-xs mt-4 mr-2">Wykonanie strony: Damian Kozłowski</span>--}}
    {{--            <br>--}}
    {{--            <span class="text-xs mb-6 mt-5 mr-2">Organizator: Urząd Miasta Poznania</span>--}}
    {{--            <br>--}}
    {{--        </div>--}}
</x-questionnaire-layout>
