@props(['title'])

<!DOCTYPE html>
<html lang="es">
<x-layouts.heads.simple-head title="{{ $title }}" />
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    <x-layouts.navigators.web-navigation />

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    {{ $slot }}
</div>
</body>
</html>
