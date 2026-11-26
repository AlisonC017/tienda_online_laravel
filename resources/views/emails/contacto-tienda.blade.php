<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo mensaje en CrikoStore</title>
</head>

<body style="margin:0; padding:0; background:#f4f4f4; font-family:Arial, Helvetica, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4; padding:30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:8px; overflow:hidden; max-width:600px;">

                    <tr>
                        <td style="background:#5a3707; padding:25px; text-align:center;">
                            <h1 style="margin:0; color:#ffffff; font-size:26px;">CrikoStore</h1>
                            <p style="margin:5px 0 0; color:#e8d9c4; font-size:14px; font-family: 'Satisfy', cursive;">
                                Compra 100% segura</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:30px 30px 10px;">
                            <h2 style="margin:0 0 10px; color:#333;">Tienes un nuevo mensaje</h2>
                            <p style="margin:0; color:#666; font-size:15px; line-height:1.5;">
                                Alguien te escribió desde la página de
                                <strong>{{ $tienda->nombre }}</strong> en CrikoStore.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:20px 30px;">
                            <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse;">
                                <tr style="border-bottom:1px solid #eee;">
                                    <td style="color:#888; font-size:13px; width:90px;">Nombre</td>
                                    <td style="color:#333; font-size:15px;"><strong>{{ $nombre }}</strong></td>
                                </tr>
                                <tr style="border-bottom:1px solid #eee;">
                                    <td style="color:#888; font-size:13px;">Correo</td>
                                    <td style="color:#333; font-size:15px;">
                                        <a href="mailto:{{ $correo }}"
                                            style="color:#AB7442;">{{ $correo }}</a>
                                    </td>
                                </tr>
                            </table>

                            <div
                                style="margin-top:20px; background:#f4ede3; border-left:4px solid #AB7442; padding:16px 18px; border-radius:4px;">
                                <p style="margin:0 0 6px; color:#5a3707; font-size:13px;"><strong>Mensaje</strong></p>
                                <p style="margin:0; color:#333; font-size:15px; line-height:1.6;">
                                    {!! nl2br(e($mensaje)) !!}</p>
                            </div>

                            <p style="text-align:center; margin:28px 0 8px;">
                                <a href="mailto:{{ $correo }}"
                                    style="background:#AB7442; color:#ffffff; text-decoration:none; padding:12px 28px; border-radius:6px; font-size:15px; display:inline-block;">
                                    Responder a {{ $nombre }}
                                </a>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="background:#f9f9f9; padding:20px 30px; text-align:center; color:#999; font-size:12px;">
                            Siquirres, Limón, Costa Rica · Lunes - Sábado 9:00 AM - 10:00 PM<br>
                            Puedes responder directamente a este correo para contestarle al visitante.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
