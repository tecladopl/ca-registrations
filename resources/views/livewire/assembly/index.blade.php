<div>
    @if($assemblies->isEmpty())
    {{ __('No Citizens Assemblies avaliable. Add new below.') }}
    @else

    <div class="p-2 grid grid-cols-12 gap-2">
        <div class=""></div>
        <div class="font-bold col-span-3">{{ __('Name') }}</div>
        <div class="font-bold col-span-5">{{ __('Description') }}</div>
        <div class="font-bold col-span-3 flex">{{ __('Actions') }}</div>
        @foreach ($assemblies as $index => $assembly)
        <div class="">
            {{$loop->index+1}}
            <span>@if($current_assembly_id === $assembly->id)
                <i class="fas fa-check text-green-400"></i>
            @endif</span>
        </div>
        <div class="col-span-3">{{$assembly->name}}</div>
        <div class="col-span-5">{{$assembly->description}}</div>
        <div class="col-span-3 flex">
            @livewire('assembly.edit', ['assembly' => $assembly], key(time().$assembly->id))
            @livewire('assembly.delete', ['assembly' => $assembly], key(time().$assembly->id))
            @if($current_assembly_id != $assembly->id) @livewire('assembly.activate', ['assembly' => $assembly], key(time().$assembly->id)) @endif
        </div>
        @endforeach
    </div>

    @endif

</div>
