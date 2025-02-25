@props(['title'])

<!DOCTYPE html>
<html lang="es">
<x-layouts.heads.simple-head title="{{ $title }}" />
<body>
{{$slot}}
</body>
</html>
