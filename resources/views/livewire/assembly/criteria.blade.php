<div>
    @if(empty($current_assembly_id))
        <p>{{ __('No Assembly avaliable.') }}</p>
        <a class="underline text-blue-600 hover:text-blue-800 visited:text-purple-600" href="{{ route('assemblies.index') }}">{{ __('Click here to add.') }}</a>
    @elseif($criteria->isEmpty())
        {{ __('No Assembly criteria avaliable. Add new below.') }}
    @else

        <div class="p-2 grid grid-cols-12 gap-2">
            <div class=""></div>
            <div class="font-bold col-span-3">{{ __('Name') }}</div>
            <div class="font-bold col-span-3">{{ __('Type') }}</div>
            <div class="font-bold col-span-2">{{ __('Priority') }}</div>
            <div class="font-bold col-span-3 flex">{{ __('Actions') }}</div>
            @foreach ($criteria as $index => $criterion)
                <div class="">{{$loop->index+1}}</div>
                <div class="col-span-3">{{$criterion->name}}</div>
                <div class="col-span-3">{{$criterion->category_type->type}}</div>
                <div class="col-span-2">{{$criterion->priority}}</div>
                <div class="col-span-3 flex">
                    @livewire('assembly.criteria.edit', ['criterion' => $criterion], key(time().$criterion->id))
                    @livewire('assembly.criteria.delete', ['criterion' => $criterion], key(time().$criterion->id))
                </div>
            @endforeach
        </div>

    @endif

</div>
