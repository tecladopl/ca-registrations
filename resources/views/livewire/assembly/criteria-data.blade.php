<div>
    @if(empty($current_assembly_id))
        <p>{{ __('No Assembly avaliable.') }}</p>
        <a class="underline text-blue-600 hover:text-blue-800 visited:text-purple-600"
           href="{{ route('assemblies.index') }}">{{ __('Click here to add.') }}</a>
    @elseif($criteria->isEmpty())
        <p>{{ __('No Assembly Criteria avaliable.') }}</p>
        <a class="underline text-blue-600 hover:text-blue-800 visited:text-purple-600"
           href="{{ route('categories.index') }}">{{ __('Click here to add.') }}</a>
    @else
        @foreach ($criteria as $index => $criterion)
            <div class="p-2 grid grid-cols-12 gap-2">
                <div class="col-span-2 text-lg">{{ __('Criterion') }} :</div>
                <div class="col-span-10 font-bold text-lg">{{$criterion->name}}</div>
            </div>
            <div>
                @if($criterion->category_values->isEmpty())
                    {{ __('No data for this criterium.') }}
                @else
                    <div class="p-2 grid grid-cols-12 gap-2">
                        <div></div>
                        @if($criterion->category_type->type=='range')
                            <div class="font-bold col-span-2">{{ __('Min') }}</div>
                            <div class="font-bold col-span-2">{{ __('Max') }}</div>
                        @else
                            <div class="font-bold col-span-4">{{ __('Value') }}</div>
                        @endif
                        <div class="font-bold col-span-3">{{ __('Amount') }}</div>
                        <div class="font-bold col-span-4">{{ __('Actions') }}</div>
                        @foreach ($criterion->category_values as $index => $criteriaData)
                            <div class="">{{$loop->index+1}}</div>
                            @if($criterion->category_type->type=='range')
                                <div class="col-span-2">{{ $criteriaData->min }}</div>
                                <div class="col-span-2">{{ $criteriaData->max }}</div>
                            @else
                                <div class="col-span-4">{{ $criteriaData->value }}</div>
                            @endif
                            <div class="col-span-3">{{ $criteriaData->amount }}</div>
                            <div class="col-span-4 flex">
                                @livewire('assembly.criteria-data.edit', ['criterionData' => $criteriaData, 'criterion'
                                => $criterion],
                                key(time().$criterion->id))
                                @livewire('assembly.criteria-data.delete', ['criterionData' => $criteriaData,
                                'criterion' => $criterion],
                                key(time().$criterion->id))
                            </div>

                        @endforeach
                    </div>
                @endif

                @livewire('assembly.criteria-data.add', ['criterion' => $criterion],
                key(time().$criterion->id))
            </div>
            <br>
            <hr>
        @endforeach


    @endif


</div>
