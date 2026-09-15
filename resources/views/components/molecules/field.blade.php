@props(['label', 'name', 'type' => 'text', 'value' => null])
<div class="field-group">
    <label class="field-label" for="{{ $name }}">{{ $label }}</label>
    @if ($type === 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['class' => 'field-input']) }}>{{ old($name, $value) }}</textarea>
    @else
        <x-atoms.input :type="$type" :name="$name" :value="$value" {{ $attributes }} />
    @endif
    @error($name)
        <p class="field-error">{{ $message }}</p>
    @enderror
</div>
