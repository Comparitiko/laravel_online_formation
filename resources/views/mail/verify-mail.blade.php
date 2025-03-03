<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Correo</title>
    @vite('resources/css/mail.css')
</head>
<body class="text-[#333] p-[20px]">
    <h1 class="text-center text-3xl">¡Hola, {{ $user->name }}!</h1>
    <main>
        <p>Gracias por registrarte en {{ config('app.name') }}.</p>
        <p class="mb-4">Para completar tu registro, haz clic en el siguiente botón para verificar tu correo:</p>

        <a href="{{ $verificationUrl }}" class="btn">Verificar Correo</a>

        <p class="footer">
            Si tienes problemas al hacer clic en el botón, copia y pega el siguiente enlace en tu navegador: <br>
            <a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a>
        </p>

        <p class="footer">Saludos,<br>{{ config('app.name') }}</p>
    </main>
</body>
</html>
