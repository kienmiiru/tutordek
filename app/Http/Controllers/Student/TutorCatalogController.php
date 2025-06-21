<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use App\Models\TeachingSession;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutorCatalogController extends Controller
{
    public function index()
    {
        $availabilities = Availability::with(['tutor', 'subject'])
            ->where('price', '>', 0)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        return view('student.tutor-catalog.index', compact('availabilities'));
    }

    public function showBookingForm(Availability $availability)
    {
        // Get available dates for the next month
        $availableDates = $this->getAvailableDates($availability->day_of_week);
        
        return view('student.tutor-catalog.booking', compact('availability', 'availableDates'));
    }

    public function storeBooking(Request $request, Availability $availability)
    {
        $validated = $request->validate([
            'date' => 'required|date|after:today',
        ]);

        // Create teaching session
        $session = TeachingSession::create([
            'student_id' => Auth::id(),
            'tutor_id' => $availability->tutor_id,
            'subject_id' => $availability->subject_id,
            'start_at' => $validated['date'] . ' ' . $availability->start_time->toTimeString(),
            'end_at' => $validated['date'] . ' ' . $availability->end_time->toTimeString(),
            'status' => 'pending_payment',
            'price' => $availability->price,
        ]);

        // Create pending payment
        Payment::create([
            'teaching_session_id' => $session->id,
            'amount' => $availability->price,
            'status' => 'pending',
        ]);

        return redirect()->route('student.tutor-catalog.index')
            ->with('success', 'Sesi les berhasil diajukan. Silakan lakukan pembayaran.');
    }

    private function getAvailableDates($dayOfWeek)
    {
        $dates = [];
        $startDate = Carbon::tomorrow();
        $endDate = Carbon::tomorrow()->addMonth();

        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            if ($currentDate->format('l') === $dayOfWeek) {
                $dates[] = $currentDate->format('Y-m-d');
            }
            $currentDate->addDay();
        }

        return $dates;
    }
} 