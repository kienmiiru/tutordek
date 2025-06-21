<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethod = PaymentMethod::first();
        return view('admin.payment-methods.index', compact('paymentMethod'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string|max:255',
        ]);

        $paymentMethod = PaymentMethod::first();
        $paymentMethod->payment_method = $request->payment_method;
        $paymentMethod->save();

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Metode pembayaran berhasil diupdate');
    }
}
