@props(['title'])

<!DOCTYPE html>
<html lang="es">
    <x-layouts.heads.simple-head title="{{ $title }}" />
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <x-layouts.navigators.private-navigation />

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
