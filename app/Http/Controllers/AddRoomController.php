<?php

namespace App\Http\Controllers;

use App\Models\Accommodations;
use App\Models\Attachments;
use App\Models\Room;
use App\Models\Video;
use Auth;
use Illuminate\Http\Request;

class AddRoomController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->permissions->accomodation_index && !Auth::user()->managedAccommodations) {
                session()->flash('dont access', 'ليس لديك سماحية الوصول الى هذه الصفحة');
                return abort(403);
            }
            return $next($request);
        });
    }

    public function accommodation(Accommodations $accommodation)
    {
        if (Auth::user()->role != "admin") {
            if (!Auth::user()->permissions->accomodation_index && Auth::user()->managedAccommodations()->first()->id != $accommodation->id) {
                session()->flash('dont access', 'ليس لديك سماحية الوصول الى هذه الصفحة');
                return abort(403);
            }
        }

        $accommodationRooms = $accommodation->rooms()->get([
            'rooms.id as id',
            'rooms.floor as floor',
            'rooms.room_number as room_number',
            'rooms.description as description',
            'rooms.category as category',
            'rooms.roomsNumber as roomsNumber',
            'rooms.bedsNumber as bedsNumber',
            'rooms.price as price',
        ]);

        return view('accomodation.add_room', [
            'accommodation' => $accommodation,
            'accommodation_rooms' => $accommodationRooms,
        ]);
    }
    public function accommodationAddRoom(Request $request)
    {
        // try {
        $room = Room::create([
            'accommodation_id' => $request->accommodation_id,
            'floor' => $request->floor,
            'room_number' => $request->room_number,
            'description' => $request->description,
            'bedsNumber' => $request->bedsNumber,
            'roomsNumber' => $request->roomsNumber,
            'price' => $request->price,
            'category' => $request->category,
            'cancellingConditions' => $request->cancellingConditions,
            'bookingConditions' => $request->bookingConditions,
            'is_available' => 1,
        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('room');
                Attachments::create([
                    'entity_type' => 'room',
                    'entity_id' => $room->id,
                    'attachment_name' => $image->getClientOriginalName(),
                    'attachment_path' => $imagePath,
                ]);
            }
        }
        if ($request->has('video_url') && $request->video_url != "") {
            Video::create([
                'room_id' => $room->id,
                'url' => $request->video_url,
            ]);
        }
        session()->flash('success', 'تم الاضافة بنجاح');
        return redirect(route('accommodation.add_room', $request->accommodation_id));
        // } catch (\Throwable $th) {
        //     return abort(500);

        // }

    }

    public function accommodationDeleteRoom($room_id)
    {
        try {
            Room::find($room_id)->delete();
            session()->flash('success', 'تم حذف الغرفة بنجاح');
            return redirect()->back();
        } catch (\Throwable $th) {
            return abort(500);
        }
    }
}
