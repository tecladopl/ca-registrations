<div>
    <form method="post" action="/{{$questionnaire->path}}">
        @csrf
    <div class="text-center m-5">
        <div class="m-auto text-center">
            <div><label class="text-center" for="code">{{__('Access code')}}</label></div>
            <x-jet-input id="code" name="code" type="text" class="mt-1" wire:model="code"/>
            <x-jet-input-error for="code" class="mt-2"/>
        </div>
    </div>
    <div class="text-center">
        @if($errors->has('session'))
            <span class="text-sm text-red-600">{{ $errors->first('session') }}</span>
        @endif
        @if($errors->has('access-error'))
            <span class="text-sm text-red-600">{{ $errors->first('access-error') }}</span>
        @endif
    </div>
    <div class="text-center m-5">
        <div class="mt-5 text-center">
            <input type="submit" name="send" value="{{__('Next')}}" class="px-4 py-2 custom-button border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
        </div>
    </div>
</div>
