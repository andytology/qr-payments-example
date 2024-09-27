<!DOCTYPE html>
<html>
<head>
    <title>Pagar con QR</title>
</head>
<body>
    <h1>Escanea el código QR para pagar $10.00</h1>
    <div>
        {!! $qrCode !!}
    </div>

    <p>Si tu dispositivo no soporta QR, puedes hacer clic en el siguiente enlace: <a href="{{ $paymentUrl }}">Pagar</a></p>
</body>
</html>
