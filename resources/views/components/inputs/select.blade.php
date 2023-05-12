<div>
    <select
        {{ $attributes->except('class') }}
        {{ $attributes->merge(['class' => 'form-input rounded-md shadow-sm mt-1 block w-full']) }}
        ></select>

    <x-jet-input-error for="name" class="mt-2" />
</div>
