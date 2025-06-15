<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailabilityController extends Controller
{
    public function index()
    {
        $availabilities = Availability::where('tutor_id', Auth::id())
            ->with('subject')
            ->get();
        $subjects = Subject::all();
        
        return view('tutor.availabilities.index', compact('availabilities', 'subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'day_of_week' => 'required|in:' . implode(',', Availability::DAYS_OF_WEEK),
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'price' => 'required|integer|min:0',
        ]);

        $validated['tutor_id'] = Auth::id();

        Availability::create($validated);

        return redirect()->route('tutor.availabilities.index')
            ->with('success', 'Jadwal ketersediaan berhasil ditambahkan');
    }

    public function update(Request $request, Availability $availability)
    {
        $this->authorize('update', $availability);

        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'day_of_week' => 'required|in:' . implode(',', Availability::DAYS_OF_WEEK),
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'price' => 'required|integer|min:0',
        ]);

        $availability->update($validated);

        return redirect()->route('tutor.availabilities.index')
            ->with('success', 'Jadwal ketersediaan berhasil diperbarui');
    }

    public function destroy(Availability $availability)
    {
        $this->authorize('delete', $availability);
        
        $availability->delete();

        return redirect()->route('tutor.availabilities.index')
            ->with('success', 'Jadwal ketersediaan berhasil dihapus');
    }
} 