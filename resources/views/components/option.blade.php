@props([
  'value',
  'selected_option'
])

<option
    class="capitalize"
    @if ($value == $selected_option)
        selected
    @endif
    value="{{ $value }}"
>
    {{ $slot }}
</option>
