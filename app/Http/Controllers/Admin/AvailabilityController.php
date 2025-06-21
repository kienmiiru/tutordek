<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Availability;

class AvailabilityController extends Controller
{
    public function index()
    {
        $availabilities = Availability::all();
        return view('admin.availabilities.index', compact('availabilities'));
    }

    public function updatePrice(Request $request, Availability $availability)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);
        
        $availability->price = $request->price;
        $availability->save();

        return redirect()->route('admin.availabilities.index')
            ->with('success', 'Harga berhasil diupdate');
    }
}
