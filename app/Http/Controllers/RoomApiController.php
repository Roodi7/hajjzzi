<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class RoomApiController extends Controller
{
    //
    public function getRoom($room_id)
    {
        $room = Room::with(['images', 'reservations', 'video', 'reviews', 'features', 'accommodation'])->find($room_id);
        $room_item = Room::with(['images', 'reservations', 'video', 'reviews', 'features', 'accommodation'])->find($room_id);


        // Check if the room exists
        if (!$room) {
            return response()->json(['error' => 'Room not found'], 404);
        }
        $roomData = $room->toArray();

        if ($room->accommodation) {
            $roomData['coordinates'] = [
                'latitude' => $room->accommodation->latitude,
                'longitude' => $room->accommodation->longitude,
            ];
        } else {
            $roomData['coordinates'] = [
                'latitude' => null,
                'longitude' => null,
            ];
        }

        $roomData['reviews'] = $room->reviews->map(function ($review) {
            return [
                'id' => $review->id,
                'rating' => $review->rating,
                'comment' => $review->comment,
                'username' => $review->user ? $review->user->name : 'Unknown',
                'created_at' => $review->created_at,
                'updated_at' => $review->updated_at,
            ];
        });
        $roomData['location'] = $room_item->accommodation->location;
        return response()->json($roomData);
    }
}
