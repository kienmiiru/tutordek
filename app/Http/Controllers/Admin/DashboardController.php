<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeachingSession;
use App\Models\User;
use App\Models\Payment;
use App\Models\Subject;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSessions = TeachingSession::count();
        $totalTutors = User::where('role', 'tutor')->count();
        $totalStudents = User::where('role', 'student')->count();
        $totalPendingPayments = Payment::where('status', 'pending')->count();
        $totalSubjects = Subject::count();  

        return view('dashboard.admin', compact('totalSessions', 'totalTutors', 'totalStudents', 'totalPendingPayments', 'totalSubjects'));
    }
}
