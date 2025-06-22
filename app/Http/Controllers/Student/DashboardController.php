<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeachingSession;
use App\Models\Payment;
use App\Models\Availability;
use App\Models\Subject;

class DashboardController extends Controller
{
    public function index()
    {
        $student = auth()->user();
        
        // Fetch student's sessions
        $sessions = TeachingSession::where('student_id', $student->id)
            ->with(['tutor', 'subject', 'payment'])
            ->latest()
            ->get();
            
        // Fetch all availabilities for booking
        $availabilities = Availability::with(['tutor', 'subject'])
            ->get();
            
        // Statistics
        $totalSessions = $sessions->count();
        $completedSessions = $sessions->where('status', TeachingSession::STATUS_COMPLETED)->count();
        $completedSessionsThisMonth = $sessions->where('status', TeachingSession::STATUS_COMPLETED)->where('end_at', '>=', now()->startOfMonth())->count();
        $pendingPayments = $sessions->where('status', TeachingSession::STATUS_PENDING_PAYMENT)->count();
        $totalTutors = $sessions->unique('tutor_id')->count();
        
        // Recent sessions (last 5)
        $recentSessions = $sessions->take(5);
        
        // Upcoming sessions
        $upcomingSessionsList = $sessions->where('end_at', '>', now())
            ->where('status', TeachingSession::STATUS_CONFIRMED)
            ->take(5);
            
        // Popular subjects from available sessions
        $popularSubjects = $availabilities->groupBy('subject_id')
            ->map(function ($group) {
                return [
                    'subject' => $group->first()->subject,
                    'count' => $group->count()
                ];
            })
            ->sortByDesc('count')
            ->take(3);
            
        // Recent payments
        $recentPayments = Payment::whereHas('teachingSession', function ($query) use ($student) {
            $query->where('student_id', $student->id);
        })->with('teachingSession.tutor')->latest()->take(5)->get();

        return view('dashboard.student', compact(
            'sessions',
            'availabilities',
            'totalSessions',
            'completedSessions',
            'pendingPayments',
            'totalTutors',
            'recentSessions',
            'upcomingSessionsList',
            'popularSubjects',
            'recentPayments',
            'completedSessionsThisMonth'
        ));
    }
} 