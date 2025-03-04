@props(['title'])

<!DOCTYPE html>
<html lang="es">
<x-layouts.heads.simple-head title="{{ $title }}" />
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    <div class="min-h-screen bg-slate-800 text-white">
        <x-layouts.navigators.web-navigation />

        <!-- Page Content -->
        {{ $slot }}
    </div>
</div>
</body>
</html>
