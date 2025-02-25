@props(['title'])

<!DOCTYPE html>
<html lang="es">
    <x-layouts.heads.simple-head title="{{ $title }}" />
    <body>
        <div class="min-h-screen bg-slate-800 text-white">
            <x-layouts.navigators.private-navigation />

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
