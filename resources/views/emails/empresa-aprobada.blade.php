<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cuenta Aprobada</title>
</head>
<body style="font-family: sans-serif; background-color: #f8fafc; padding: 40px; color: #333;">
    <h2 style="color: #2d3748;">Hola {{ $empresa->name }},</h2>

    <p>Nos complace informarte que tu cuenta en <strong>CV Book Empresarial</strong> ha sido <strong>aprobada</strong>.</p>

    <p>Ya puedes acceder a la plataforma para buscar talento profesional:</p>

    <p style="margin-top: 20px;">
        <a href="{{ route('login') }}" style="display: inline-block; padding: 12px 24px; background-color: #2563eb; color: white; text-decoration: none; border-radius: 6px;">
            Iniciar Sesión
        </a>
    </p>

    <p style="margin-top: 30px;">Gracias por confiar en nosotros,<br>El equipo de CV Book</p>
</body>
</html>
