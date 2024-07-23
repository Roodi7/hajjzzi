<?php
namespace App\Http\Controllers;

use App\Models\Accommodations;
use App\Models\ChaletSection;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Mail;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::with('user', 'accommodation', 'room');
        $users = User::all();
        $accommodations = Accommodations::all();
        $printData = null;

        if (Auth()->user()->role == 'manager') {
            $accomodation_id = User::join('accommodations', 'users.id', 'accommodations.manager_id')->where('users.id', Auth::id())->get(['accommodations.id as accommodation_id'])->first()->accommodation_id;
            $reservations = Reservation::with('user', 'accommodation', 'room')->where('accommodation_id', '=', $accomodation_id);

        }
        if ($request->has('search_reservations')) {


            if ($request->reservation_id_search_check) {
                $reservations->where(function ($query) use ($request) {
                    $query->where('id', $request->reservation_id_search)
                        ->orWhere('phone_number', $request->reservation_id_search);
                })
                    ->paginate(25);
            }

            if ($request->accommodation_check) {
                $reservations->where('accommodation_id', $request->accommodation_search);
            }
            if ($request->status_check) {
                $reservations->where('status', $request->status_search);
            }
            if ($request->pay_status_check) {
                $reservations->where('pay_status', $request->pay_status_search);
            }
            if ($request->account_id_check) {
                $reservations->where('user_id', $request->account_id_search);
            }
            if ($request->reservation_name_search_check) {
                $reservations->where('name', 'LIKE', '%' . $request->reservation_name_search . '%');
            }

            if ($request->date_search_check) {
                $reservations->whereBetween('start_date', [$request->from_date, $request->to_date]);
            }
            $printData = $reservations->get();
            $request->session()->put('print_data', $reservations->get());
        }
        $reservations = $reservations->paginate(25);
        return view('reservations.index', [
            'reservations' => $reservations,
            'users' => $users,
            'accommodations' => $accommodations,
            'printData' => $printData,

        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'accommodation_id' => 'required|exists:accommodations,id',
            'room_id' => 'nullable|exists:rooms,id',
            'chalet_section_id' => 'nullable|exists:chalet_sections,id',
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'user_id' => 'required',
        ]);

        $accommodation = Accommodations::findOrFail($validatedData['accommodation_id']);

        if ($this->isReserved($accommodation, $validatedData['room_id'], $validatedData['chalet_section_id'], $validatedData['start_date'], $validatedData['end_date'])) {
            return response()->json(['message' => 'The accommodation, room, or section is not available for the selected dates.'], 422);
        }

        $reservation = Reservation::create($validatedData);

        return response()->json($reservation, 201);
    }

    private function isReserved($accommodation, $roomId, $sectionId, $startDate, $endDate)
    {
        $query = $accommodation->reservations()->where(function ($query) use ($startDate, $endDate) {
            $query->whereBetween('start_date', [$startDate, $endDate])
                ->orWhereBetween('end_date', [$startDate, $endDate])
                ->orWhere(function ($query) use ($startDate, $endDate) {
                    $query->where('start_date', '<=', $startDate)
                        ->where('end_date', '>=', $endDate);
                });
        });

        if ($roomId) {
            $query->where('room_id', $roomId);
        }

        if ($sectionId) {
            $query->where('chalet_section_id', $sectionId);
        }
        $query->where('status', 'accepted');

        return $query->exists();
    }
    public function edit(Reservation $reservation)
    {
        $accommodations = Accommodations::all();
        $rooms = Room::all();
        $chaletSections = ChaletSection::all();
        return view('reservations.edit', compact('reservation', 'accommodations', 'rooms', 'chaletSections'));
    }

    public function update(Request $request, $reservation)
    {
        $reservation = Reservation::findOrFail($reservation);
        $request->validate([
            'status' => 'required|string|in:pending,accepted,denied',
            'pay_status' => 'required|string|in:unpaid,paid',
        ]);

        $reservation->update(['status' => $request->status, 'pay_status' => $request->pay_status]);
        return redirect()->route('reservations.index');
    }


    public function accept($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);

            $data = array('name' => $reservation->user->name, 'start_date' => $reservation->start_date, 'end_date' => $reservation->end_date);
            Mail::send('confirm_reservation', $data, function ($message) use ($reservation) {
                $message->to($reservation->user->email, $reservation->user->name)->subject('Hajzi Confirm Reservation');
                $message->from('info@hajjzi.com', 'Hajjzi Info');
            });
            $reservation->update(['status' => 'accepted']);
            return redirect()->route('reservations.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['لم يتم تاكيد الحجز,حصل خطأ']);
        }
    }

    public function deny($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'denied']);

        return redirect()->route('reservations.index');
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservations.index');
    }


    public function create()
    {
        $accommodations = Accommodations::all();
        $rooms = Room::all();
        $chaletSections = ChaletSection::all();
        return view('reservations.create', compact('accommodations', 'rooms', 'chaletSections'));
    }


    public function print_search()
    {
        $reservations = session()->get('print_data');
        return view('reservations.print_search', compact('reservations'));
    }

}