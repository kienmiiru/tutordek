<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\TeachingSession;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = TeachingSession::all();
        return view('admin.sessions.index', compact('sessions'));
    }

    public function updatePaymentStatus(Request $request, TeachingSession $session)
    {
        $this->authorize('update', $session);
        
        $request->validate([
            'status' => 'required|in:' . Payment::STATUS_VERIFIED . ',' . Payment::STATUS_REJECTED,
        ]);

        $payment = $session->payment;
        $payment->status = $request->status;
        $payment->verified_by = Auth::id();
        $payment->verified_at = now();
        
        if ($request->status === Payment::STATUS_VERIFIED) {
            $session->status = TeachingSession::STATUS_CONFIRMED;
        } else {
            $session->status = TeachingSession::STATUS_REJECTED;
        }
        
        $payment->save();
        $session->save();

        return redirect()->route('admin.sessions.index')
            ->with('success', 'Status pembayaran berhasil diupdate');
    }
}
