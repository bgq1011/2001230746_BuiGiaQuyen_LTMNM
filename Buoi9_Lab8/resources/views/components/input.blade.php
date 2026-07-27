@props([
    'name',
    'label' => '',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false
])

<div style="margin-bottom: 10px;">
    @if($label)
        <label for="{{ $name }}" style="display: block; margin-bottom: 3px;">{{ $label }}</label>
    @endif
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        value="{{ old($name, $value) }}" 
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        style="width: 100%; padding: 6px; box-sizing: border-box;"
    >
    @if ($errors->has($name))
        <div style="color: red; font-size: 13px;">{{ $errors->first($name) }}</div>
    @endif
</div>
