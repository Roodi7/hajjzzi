<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Accommodations;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationManagementController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('user', 'accommodation', 'room')->paginate(25);

        if (Auth()->user()->role == 'manager') {
           $accomodation_id = User::join('accommodations', 'users.id', 'accommodations.manager_id')->where('users.id', Auth::id())->get(['accommodations.id as accommodation_id'])->first()->accommodation_id;
           $reservations = Reservation::with('user', 'accommodation', 'room')->where('accommodation_id','=',$accomodation_id)->paginate(25);

        }
        foreach ($reservations as $reservation) {
            $reservation->total_price = $reservation->calculateTotalPrice();
        }
        return view('admin.reservations.index', compact('reservations'));
    }

    public function edit(Reservation $reservation)
    {
        $accommodations = Accommodations::all();
        $rooms = Room::where('accommodation_id', $reservation->accommodation_id)->get();
        $total_price = $reservation->calculateTotalPrice();
        return view('admin.reservations.edit', compact('reservation', 'accommodations', 'rooms', 'total_price'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'accommodation_id' => 'nullable|exists:accommodations,id',
            'room_id' => 'nullable|exists:rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:pending,accepted,rejected',
            'is_paid' => 'required|boolean',
        ]);

        $reservation->update([
            'accommodation_id' => $request->input('accommodation_id'),
            'room_id' => $request->input('room_id'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'status' => $request->input('status'),
            'is_paid' => $request->input('is_paid'),
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }
}
