<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felicitaciones, has sido aceptado/a</title>
    @vite('resources/css/mail.css')
</head>
<body class="text-[#333] p-[20px]">
    <h1 class="text-center text-3xl">¡Hola, {{ $user->name }}!</h1>
    <main>
        <p>Gracias por inscribirte en el curso: {{ $registration->course->name }}.</p>
        <p class="mb-4">Le mandamos este mensaje para comunicarle que ha sido aceptado/a en el curso, Enhorabuena</p>

        <p class="footer">Saludos,<br>{{ config('app.name') }}</p>
    </main>
</body>
</html>
