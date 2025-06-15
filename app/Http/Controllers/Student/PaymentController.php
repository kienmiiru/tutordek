<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\TeachingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['teachingSession.tutor', 'teachingSession.subject'])
            ->whereHas('teachingSession', function ($query) {
                $query->where('student_id', Auth::id());
            })
            ->latest()
            ->get();

        // dd($payments->toArray());
        return view('student.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        $this->authorize('view', $payment);

        return view('student.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $this->authorize('update', $payment);

        if ($payment->status !== 'pending') {
            return redirect()->route('student.payments.index')
                ->with('error', 'Pembayaran ini tidak dapat diubah.');
        }
        
        return view('student.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $this->authorize('update', $payment);

        if ($payment->status !== 'pending') {
            return redirect()->route('student.payments.index')
                ->with('error', 'Pembayaran ini tidak dapat diubah.');
        }

        $validated = $request->validate([
            'payment_proof' => 'required|image|max:2048', // max 2MB
        ]);

        // Store the payment proof
        $path = $request->file('payment_proof')->store('payment-proofs', 'public');

        // Update payment record
        $payment->update([
            'payment_proof_path' => $path,
        ]);

        // Update teaching session status
        $payment->teachingSession->update([
            'status' => 'awaiting_verification',
        ]);

        return redirect()->route('student.payments.index')
            ->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi dari admin.');
    }
} 