<?php

namespace App\Http\Controllers;

use App\Models\Accommodations;
use App\Models\Room;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Auth;
use DB;

class ReservationApiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->with('accommodation', 'room')->get();

        return response()->json($reservations);
    }

    public function reservationByAccommodation($accommodation_id)
    {
        $reservations = Reservation::where('accommodation_id', $accommodation_id)->get(['start_date', 'end_date']);
        return response()->json($reservations);
    }

    public function reservationByRoom($room_id)
    {
        $reservations = Reservation::where('room_id', $room_id)->get(['start_date', 'end_date']);
        return response()->json($reservations);
    }
    public function reservationBySection($chalet_section_id)
    {
        $reservations = Reservation::where('chalet_section_id', $chalet_section_id)->get(['start_date', 'end_date']);
        return response()->json($reservations);
    }

    public function store(Request $request)
    {
        $this->validateReservationRequest($request);

        $accommodation = $this->getAccommodation($request->accommodation_id);
        $reservation = $this->createReservation($request, $accommodation);

        return $this->sendSuccessResponse($reservation, 201);
    }

    private function validateReservationRequest(Request $request)
    {
        $accommodation = Accommodations::findOrFail($request->accommodation_id);
        // dd($accommodation);
        if ($this->isReserved($accommodation->id, $request->room_id, $request->chalet_section_id, $request->start_date, $request->end_date)) {
            throw new ValidationException('The accommodation, room, or section is not available for the selected dates.');
        }

    }

    private function getAccommodation($accommodationId)
    {
        return Accommodations::findOrFail($accommodationId);
    }

    private function createReservation(Request $request, Accommodations $accommodation)
    {
        return DB::transaction(function () use ($request, $accommodation) {
            $reservation = $accommodation->reservations()->create([
                'room_id' => $request->room_id,
                'chalet_section_id' => $request->chalet_section_id,
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'user_id' => $request->user_id,
            ]);

            return $reservation;
        });
    }
    private function sendSuccessResponse($data, $statusCode)
    {
        return response()->json($data, $statusCode);
    }



    private function isReserved($accommodation, $roomId, $sectionId, $startDate, $endDate)
    {
        $accommodation = Accommodations::findOrFail($accommodation);

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
        // $query->where('status', 'accepted');

        return $query->exists();
    }

    public function getRooms($accommodationId)
    {
        $rooms = Room::where('hotel_id', $accommodationId)->get();
        return response()->json($rooms);
    }
}
