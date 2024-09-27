<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Stripe\Stripe;

class QRCodePaymentController extends Controller
{
     // Mostrar el QR para el pago
     public function showQRPayment()
     {
         // Aquí simulamos un precio fijo de $10.00 para el ejemplo
         $amount = 1000; // Monto en centavos (10.00 USD)
         
         // Generar un enlace único para el pago
         $paymentUrl = route('payment.process', ['amount' => $amount]);
 
         // Generar el código QR con el enlace de pago
         $qrCode = QrCode::size(250)->generate($paymentUrl);
 
         // Mostrar la vista con el código QR
         return view('qrcode_payment', compact('qrCode', 'paymentUrl'));
     }
 
     // Procesar el pago cuando el usuario escanee el código QR
     public function processPayment(Request $request)
     {
         // Configurar la clave secreta de Stripe
         Stripe::setApiKey(env('STRIPE_SECRET'));
 
         // Procesar el pago usando Stripe
         $paymentMethod = $request->input('paymentMethod'); // Método de pago proporcionado por el cliente (tarjeta)
         $amount = $request->input('amount'); // Monto a pagar
         
         try {
             // Realizar el cargo
             $request->user()->charge($amount, $paymentMethod);
             return redirect()->route('payment.success');
         } catch (\Exception $e) {
             return redirect()->route('payment.failure')->withErrors(['error' => $e->getMessage()]);
         }
     }
}
