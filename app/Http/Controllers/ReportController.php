<?php
namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Accommodations;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $accommodations = Accommodations::all();
        return view('reports.index', compact('accommodations'));
    }

    public function show(Request $request)
    {
        $request->validate([
            'accommodation_id' => 'required|exists:accommodations,id'
        ]);

        $accommodation = Accommodations::findOrFail($request->accommodation_id);
        $reservations = Reservation::where('accommodation_id', $accommodation->id)->get();
        $totalRevenue = $reservations->sum('total_price');

        return view('reports.show', compact('accommodation', 'reservations', 'totalRevenue'));
    }
}
