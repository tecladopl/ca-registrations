<div>
    <form method="post" action="/">
        @csrf
        <div class="text-center m-5">
            <div class="m-auto text-center">
                <div><label class="text-center" for="name">{{__('Kutse number')}}</label></div>
                <x-jet-input id="name" name="name" type="text" class="mt-1" wire:model="name"/>
                <x-jet-input-error for="name" class="mt-2"/>
            </div>
        </div>
        <div class="text-center m-5">
            <div class="m-auto text-center">
                <div><label class="text-center" for="access_code">{{__('Parool')}}</label></div>
                <x-jet-input id="access_code" name="access_code" type="text" class="mt-1" wire:model="access_code"/>
                <x-jet-input-error for="access_code" class="mt-2"/>
            </div>
        </div>
        <div class="text-center">
            @if($errors->has('session'))
                <span class="text-sm text-red-600">{{ $errors->first('session') }}</span>
            @endif
        </div>
        <div class="text-center">
            @if($errors->has('access-error'))
                <span class="text-sm text-red-600">{{ $errors->first('access-error') }}</span>
            @endif
        </div>
        <div class="text-center m-5">
            <div class="mt-5 text-center">
                <input type="submit" name="send" value="{{__('Järgmine')}}"
                       class="px-4 py-2 color-blue2 border border-transparent rounded-md font-bold text-xs uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
            </div>
        </div>
</div>
