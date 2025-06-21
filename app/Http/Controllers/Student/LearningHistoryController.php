<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\TeachingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LearningHistoryController extends Controller
{
    public function index()
    {
        $sessions = TeachingSession::with(['tutor', 'subject', 'payment'])
            ->where('student_id', Auth::id())
            ->whereIn('status', [TeachingSession::STATUS_COMPLETED, TeachingSession::STATUS_REJECTED])
            ->orderBy('start_at', 'desc')
            ->paginate(10);

        return view('student.learning-history.index', compact('sessions'));
    }

    public function show(TeachingSession $session)
    {
        // Ensure the student can only view their own sessions
        if ($session->student_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $session->load(['tutor', 'subject', 'payment']);
        
        return view('student.learning-history.show', compact('session'));
    }

    public function downloadMaterial(TeachingSession $session)
    {
        // Ensure the student can only download materials from their own sessions
        if ($session->student_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if (!$session->material) {
            return back()->with('error', 'Bahan ajar tidak tersedia.');
        }

        if (!Storage::disk('public')->exists($session->material)) {
            return back()->with('error', 'File bahan ajar tidak ditemukan.');
        }

        return Storage::disk('public')->download($session->material);
    }
} 