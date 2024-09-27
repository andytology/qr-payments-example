<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QRCodePaymentController;

// Ruta para mostrar el QR
Route::get('/', [QRCodePaymentController::class, 'showQRPayment'])->name('qr.payment');

// Ruta para procesar el pago (debe existir esta ruta)
Route::post('/process-payment', [QRCodePaymentController::class, 'processPayment'])->name('payment.process');

// Ruta para manejar el éxito del pago
Route::get('/payment-success', function () {
    return '¡Pago realizado con éxito!';
})->name('payment.success');

// Ruta para manejar el fallo del pago
Route::get('/payment-failure', function () {
    return 'Hubo un error en el pago.';
})->name('payment.failure');
