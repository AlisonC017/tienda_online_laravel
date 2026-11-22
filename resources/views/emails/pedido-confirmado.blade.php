<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
</head>

<body style="margin:0; padding:0; background:#f4f4f4; font-family:Arial, Helvetica, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4; padding:30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:8px; overflow:hidden;">

                    <tr>
                        <td style="background:#5a3707; padding:25px; text-align:center;">
                            <h1 style="margin:0; color:#ffffff; font-size:26px;">CrikoStore</h1>
                            <p style="margin:5px 0 0; color:#e8d9c4; font-size:14px;">Compra 100% segura</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:30px 30px 10px;">
                            <h2 style="margin:0 0 10px; color:#333;">¡Gracias por tu compra, {{ $pedido->cliente }}!
                            </h2>
                            <p style="margin:0; color:#666; font-size:15px;">
                                Recibimos tu pedido <strong>#{{ $pedido->id_pedido }}</strong> el
                                {{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y H:i') }}.
                                Estado: <strong>{{ $pedido->estado }}</strong>.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:20px 30px;">
                            <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse;">
                                <thead>
                                    <tr style="background:#f4ede3; color:#5a3707; font-size:13px; text-align:left;">
                                        <th>Producto</th>
                                        <th>Tienda</th>
                                        <th style="text-align:center;">Cant.</th>
                                        <th style="text-align:right;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pedido->detalles as $item)
                                        <tr style="border-bottom:1px solid #eee; font-size:14px; color:#333;">
                                            <td>{{ $item->nombre_producto }}</td>
                                            <td style="color:#888;">{{ $item->nombre_tienda }}</td>
                                            <td style="text-align:center;">{{ $item->cantidad }}</td>
                                            <td style="text-align:right;">
                                                ₡{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <p style="text-align:right; font-size:18px; color:#5a3707; margin:20px 0 0;">
                                <strong>Total: ₡{{ number_format($pedido->total, 0, ',', '.') }}</strong>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="background:#f9f9f9; padding:20px 30px; text-align:center; color:#999; font-size:12px;">
                            Siquirres, Limón, Costa Rica · Lunes - Sábado 9:00 AM - 10:00 PM<br>
                            Este correo fue generado automáticamente, por favor no respondas a este mensaje.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
