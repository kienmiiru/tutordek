<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeachingSession;
use App\Models\Availability;
use App\Models\Subject;

class DashboardController extends Controller
{
    public function index()
    {
        $tutor = auth()->user();
        
        // Fetch tutor's sessions
        $sessions = TeachingSession::where('tutor_id', $tutor->id)
            ->with(['student', 'subject', 'payment'])
            ->latest()
            ->get();
            
        // Fetch tutor's availabilities
        $availabilities = Availability::where('tutor_id', $tutor->id)
            ->with('subject')
            ->get();
            
        // Statistics
        $totalSessions = $sessions->count();
        $confirmedSessions = $sessions->where('status', TeachingSession::STATUS_CONFIRMED)->count();
        $completedSessions = $sessions->where('status', TeachingSession::STATUS_COMPLETED)->count();
        $pendingSessions = $sessions->where('status', TeachingSession::STATUS_PENDING_PAYMENT)->count();
        $totalEarnings = $sessions->where('status', TeachingSession::STATUS_COMPLETED)->sum('price');
        $totalSubjects = $availabilities->unique('subject_id')->count();
        
        // Recent sessions (last 5)
        $recentSessions = $sessions->take(5);
        
        // Upcoming sessions
        $upcomingSessions = $sessions->where('start_at', '>', now())
            ->where('status', TeachingSession::STATUS_CONFIRMED)
            ->take(5);
            
        // Popular subjects
        $popularSubjects = $availabilities->groupBy('subject_id')
            ->map(function ($group) {
                return [
                    'subject' => $group->first()->subject,
                    'count' => $group->count()
                ];
            })
            ->sortByDesc('count')
            ->take(3);

        return view('dashboard.tutor', compact(
            'sessions',
            'availabilities',
            'totalSessions',
            'confirmedSessions',
            'completedSessions',
            'pendingSessions',
            'totalEarnings',
            'totalSubjects',
            'recentSessions',
            'upcomingSessions',
            'popularSubjects'
        ));
    }
} 