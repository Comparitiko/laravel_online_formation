@props([
  'value',
  'text',
  'selected_option'
])

<option
    @if ($value === $selected_option)
        selected
    @endif
    value="{{ $value }}"
>
    {{ $slot }}
</option>
