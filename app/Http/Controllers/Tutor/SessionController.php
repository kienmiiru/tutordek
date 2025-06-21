<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\TeachingSession;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = TeachingSession::with(['student', 'subject', 'payment'])
            ->where('tutor_id', Auth::id())
            ->whereNotIn('status', [TeachingSession::STATUS_COMPLETED, TeachingSession::STATUS_REJECTED])
            ->orderBy('scheduled_at', 'asc')
            ->paginate(10);

        return view('tutor.sessions.index', compact('sessions'));
    }

    public function show(TeachingSession $session)
    {
        $this->authorize('view', $session);
        $session->load(['student', 'subject', 'payment']);
        return view('tutor.sessions.show', compact('session'));
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

        return redirect()->route('tutor.sessions.show', $session)
            ->with('success', 'Status pembayaran berhasil diupdate');
    }

    public function updateSessionStatus(Request $request, TeachingSession $session)
    {
        $this->authorize('update', $session);
        
        $request->validate([
            'status' => 'required|in:' . TeachingSession::STATUS_COMPLETED,
        ]);

        $session->status = $request->status;
        $session->save();

        return redirect()->route('tutor.sessions.show', $session)
            ->with('success', 'Sesi les berhasil ditandai selesai');
    }

    public function updateMeetingLink(Request $request, TeachingSession $session)
    {
        $this->authorize('update', $session);
        
        $request->validate([
            'meeting_link' => 'required|url',
        ]);

        $session->meeting_link = $request->meeting_link;
        $session->save();

        return redirect()->route('tutor.sessions.show', $session)
            ->with('success', 'Link meeting berhasil diupdate');
    }

    public function updateMaterial(Request $request, TeachingSession $session)
    {
        $this->authorize('update', $session);
        
        $request->validate([
            'material' => 'required|file|max:2048',
        ]);

        $path = $request->file('material')->store('materials', 'public');
        $session->material = $path;
        $session->save();

        return redirect()->route('tutor.sessions.show', $session)
            ->with('success', 'Material berhasil diupdate');
    }

    public function history()
    {
        $sessions = TeachingSession::with(['student', 'subject', 'payment'])
            ->where('tutor_id', Auth::id())
            ->whereIn('status', [TeachingSession::STATUS_COMPLETED, TeachingSession::STATUS_REJECTED])
            ->orderBy('scheduled_at', 'desc')
            ->paginate(10);

        return view('tutor.sessions.history', compact('sessions'));
    }
} 