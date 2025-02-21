<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Correo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            padding: 20px;
        }
        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
<h1 class="text-center">¡Hola, {{ $user->name }}!</h1>
<p>Gracias por registrarte en {{ config('app.name') }}.</p>
<p>Para completar tu registro, haz clic en el siguiente botón para verificar tu correo:</p>

<a href="{{ $verificationUrl }}" class="button">Verificar Correo</a>

<p class="footer">
    Si tienes problemas al hacer clic en el botón, copia y pega el siguiente enlace en tu navegador: <br>
    <a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a>
</p>

<p class="footer">Saludos,<br>{{ config('app.name') }}</p>
</body>
</html>
