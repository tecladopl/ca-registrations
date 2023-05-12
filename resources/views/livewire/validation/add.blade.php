<div class="mt-8">
    <x-jet-action-section>
        <x-slot name="title">
            {{ __('Add Validation') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Add new Validation') }}
        </x-slot>

        <x-slot name="content">

            <div class="mt-5">
                <x-jet-button wire:click="modal" wire:loading.attr="disabled">
                    {{ __('Add Validation') }}
                </x-jet-button>
            </div>

            <x-jet-dialog-modal wire:model="modal">
                <form wire:submit.prevent="save">
                    <x-slot name="title">
                        {{ __('Adding Validation') }}
                    </x-slot>

                    <x-slot name="content">
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="name" wire:model.defer="name" autocomplete="name" />
                            <x-jet-input-error for="name" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="path" value="{{ __('Attach to') }}" />
                            <select id="attach" name="attach" class="form-input rounded-md shadow-sm mt-1 block w-full" wire:model="attach">
                                <option>{{__('-- pick right option --')}}</option>
                                <option value="1">{{__('Question')}}</option>
                                <option value="2">{{__('Answer')}}</option>
                            </select>
                        </div>
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            @if($attach==1)
                                <p>{{ __('Choose questions') }}</p>
                                @foreach($questions as $question)
                                    <div>
                                        <input
                                            class="mb-1 mr-1  rounded text-gray-800 border-gray-900 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-50"
                                            type="checkbox" id="question_ids[{{$question->id}}]" name="question_ids[{{$question->id}}]"
                                            wire:model.defer="question_ids"
                                            @if(!empty($questions->where('question_id',$question->id)->last())) checked="checked" @endif
                                            value="{{$question->id}}"><label class="inline"
                                            for="{{$question->id}}">{{$question->question}}</label>
                                    </div>
                                @endforeach
                            @elseif($attach==2)
                                <p>{{ __('Choose answers') }}</p>
                                @foreach($answers as $answer)
                                    <div>
                                        <input
                                            class="mb-1 mr-1 rounded inline text-gray-800 border-gray-900 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-900 focus:ring-opacity-50"
                                            type="checkbox" id="answer_ids[{{$answer->id}}]" name="answer_ids[{{$answer->id}}]"
                                            wire:model.defer="answer_ids"
                                            @if(!empty($answers->where('answer_id',$answer->id)->last())) checked="checked" @endif
                                            value="{{$answer->id}}"><label class="inline"
                                            for="{{$answer->id}}">{{$answer->text}}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="path" value="{{ __('Validation rule') }}" />
                            <select id="rule" name="rule" class="form-input rounded-md shadow-sm mt-1 block w-full" wire:model="rule">
                                <option>{{__('-- pick right option --')}}</option>
                                <option value="1">{{__('Required')}}</option>
                                <option value="2">{{__('Required minimum one from')}}</option>
                            </select>
                            <x-jet-input-error for="rule" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="message" value="{{ __('Error message') }}" />
                            <x-jet-input id="message" type="text" class="mt-1 block w-full" wire:model="message" wire:model.defer="message" autocomplete="message" />
                            <x-jet-input-error for="message" class="mt-2" />
                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$toggle('modal')" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-jet-secondary-button>

                        <x-jet-danger-button  type="submit" class="ml-2" wire:click="addValidation" wire:loading.attr="disabled">
                            {{ __('Save') }}
                        </x-jet-danger-button>
                    </x-slot>
                </form>
            </x-jet-dialog-modal>
        </x-slot>
    </x-jet-action-section>
</div>
