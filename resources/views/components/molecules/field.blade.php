@props(['label', 'name', 'type' => 'text', 'value' => null])
<div class="field-group">
    <label class="field-label" for="{{ $name }}">{{ $label }}</label>
    <x-atoms.input :type="$type" :name="$name" :value="$value" {{ $attributes }} />
    @error($name)
        <p class="field-error">{{ $message }}</p>
    @enderror
</div>
