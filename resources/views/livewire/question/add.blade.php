<div class="mt-8">
    <x-jet-action-section>
        <x-slot name="title">
            {{ __('Add Question') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Add new Question') }}
        </x-slot>

        <x-slot name="content">

            <div class="mt-5">
                <x-jet-button wire:click="modal" wire:loading.attr="disabled">
                    {{ __('Add Question') }}
                </x-jet-button>
            </div>

            <x-jet-dialog-modal wire:model="modal">
                <form wire:submit.prevent="save">
                    <x-slot name="title">
                        {{ __('Adding Question') }}
                    </x-slot>

                    <x-slot name="content">
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="path" value="{{ __('Page') }}" />
                            <select id="questionnaire_page_id" name="questionnaire_page_id" class="form-input rounded-md shadow-sm mt-1 block w-full" wire:model="questionnaire_page_id">
                                <option>{{__('-- pick right option --')}}</option>
                                @foreach($questionnaire_pages as $page)
                                    <option value="{{$page->id}}">{{$page->title}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="questionnaire_page_id" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="path" value="{{ __('Type') }}" />
                            <select id="question_type_id" name="question_type_id" class="form-input rounded-md shadow-sm mt-1 block w-full" wire:model="question_type_id">
                                <option>{{__('-- pick right option --')}}</option>
                                <option value="1">{{__('Multiple choise')}}</option>
                                <option value="2">{{__('Single choise')}}</option>
                                <option value="4">{{__('Text')}}</option>
                                <option value="5">{{__('Long text')}}</option>
                                <option value="6">{{__('Date')}}</option>
                                <option value="7">{{__('Number')}}</option>
                                <option value="8">{{__('Email')}}</option>
                            </select>
                            <x-jet-input-error for="question_type_id" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="name" value="{{ __('Question') }}" />
                            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="name" wire:model.defer="name" autocomplete="name" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="subtext" value="{{ __('Subtext') }}" />
                            <x-inputs.textarea wire:model="subtext" wire:model.defer="subtext" />
                        </div>
                        @if(in_array($question_type_id, [4,5,6,7,8]))
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="label" value="{{ __('Label') }}" />
                                <x-jet-input id="label" type="text" class="mt-1 block w-full" wire:model="label" wire:model.defer="label" autocomplete="label" />
                            </div>
                        @endif
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="order" value="{{ __('Order') }}" />
                            <x-jet-input id="order" type="number" step="1" min="1" class="mt-1 block w-full" wire:model="order" wire:model.defer="order" autocomplete="order" />
                            <x-jet-input-error for="order" class="mt-2" />
                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$toggle('modal')" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-jet-secondary-button>

                        <x-jet-danger-button  type="submit" class="ml-2" wire:click="addQuestion" wire:loading.attr="disabled">
                            {{ __('Save') }}
                        </x-jet-danger-button>
                    </x-slot>
                </form>
            </x-jet-dialog-modal>
        </x-slot>
    </x-jet-action-section>
</div>
