<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\StoreReviewRequest;
use App\Models\Accommodations;
use App\Models\Review;
use Illuminate\Http\Request;

class AccommodationApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Accommodations::with('availableRooms', 'images');

        if ($type = $request->query('type')) {
            if (in_array($type, ['hotels', 'chalets', 'halls', 'appartments'])) {
                $query = $query->$type();
            } else {
                return response()->json(['message' => 'Invalid type specified'], 400);
            }
        }

        $accommodations = $query->get();
        // Transform the data
        $transformedData = $accommodations->map(function ($item) {
            return [
                'id' => $item->id,
                'type' => $item->type,
                'name' => $item->name,
                'cityId' => $item->city_id,
                'location' => $item->location,
                'shortDescription' => $item->short_description,
                'description' => $item->description,
                'capacity' => $item->capacity,
                'bookingConditions' => $item->bookingConditions,
                'cancellingConditions' => $item->cancellingConditions,
                'price' => $item->price,
                'numberOfStars' => $item->rating,
                'phone' => $item->phone,
                'coordinates' => [
                    'longitude' => $item->longitude,
                    'latitude' => $item->latitude,
                ],
                'availability' => $item->availability,
                'notes' => $item->notes,
                'createdAt' => $item->created_at,
                'updatedAt' => $item->updated_at,
                'managerId' => $item->manager_id,
                'availableRooms' => $item->availableRooms,
                'images' => $item->images,
            ];
        });

        return response()->json($transformedData);
    }

    // Get a specific accommodation by ID with its available rooms
    public function show($id)
    {
        $accommodation = Accommodations::with('availableRooms')
            ->with('rooms')
            ->with('images')
            ->with('BookingConditions')
            ->with('features')
            ->with('reviews')
            ->with('reviews.user')
            ->with('reservations')
            ->with('video')
            ->find($id);

        if (!$accommodation) {
            return response()->json(['message' => 'Accommodation not found'], 404);
        }


        // Transform the data
        $transformedAccommodation = [
            'id' => $accommodation->id,
            'type' => $accommodation->type,
            'name' => $accommodation->name,
            'city_id' => $accommodation->city_id,
            'location' => $accommodation->location,
            'short_description' => $accommodation->short_description,
            'description' => $accommodation->description,
            'numberOfRooms' => $accommodation->capacity,
            'pricePerNight' => $accommodation->price,
            'numberOfStars' => $accommodation->rating,
            'bookingConditions' => $accommodation->bookingConditions,
            'cancellingConditions' => $accommodation->cancellingConditions,
            'phone' => $accommodation->phone,
            'coordinates' => [
                'longitude' => $accommodation->longitude,
                'latitude' => $accommodation->latitude,
            ],
            'availability' => $accommodation->availability,
            'notes' => $accommodation->notes,
            'created_at' => $accommodation->created_at,
            'updated_at' => $accommodation->updated_at,
            'manager_id' => $accommodation->manager_id,
            'availableRooms' => $accommodation->availableRooms,
            'rooms' => $accommodation->rooms,
            'images' => $accommodation->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'entityType' => $image->entity_type,
                    'entityId' => $image->entity_id,
                    'attachmentName' => $image->attachment_name,
                    'attachmentPath' => $image->attachment_path,
                    'createdAt' => $image->created_at,
                    'updatedAt' => $image->updated_at,
                ];
            }),
            'features' => $accommodation->features,
            'reviews' => $accommodation->reviews,
            'reservations' => $accommodation->reservations,
            'video' => $accommodation->video->map(function ($video) {
                return [
                    'id' => $video->id,
                    'accommodationId' => $video->accommodation_id,
                    'room_id' => $video->room_id,
                    'url' => $video->url,
                    'created_at' => $video->created_at,
                    'updated_at' => $video->updated_at,
                ];
            }),
        ];

        return response()->json([
            'accommodation' => $transformedAccommodation,
        ]);

    }


    public function showWithAllData($id)
    {
        $accommodation = Accommodations::with('availableRooms')
            ->with('rooms')
            ->with('images')
            ->with('BookingConditions')
            ->with('features')
            ->with('reviews')
            ->with('reviews.user')
            ->with('video')
            ->find($id);
        if (!$accommodation) {
            return response()->json(['message' => 'Accommodation not found'], 404);
        }

        return response()->json(
            [
                'accommodation' => $accommodation,
            ]
        );
    }

    public function terms($id)
    {
        $accommodation = Accommodations::find($id);

        if (!$accommodation) {
            return response()->json(['message' => 'Accommodation not found'], 404);
        }

        return response()->json($accommodation->terms);
    }
    public function rooms($id)
    {
        $accommodation = Accommodations::find($id);
    
        if (!$accommodation) {
            return response()->json(['message' => 'Accommodation not found'], 404);
        }
    
        if ($accommodation->type == 'chalet') {
            $accommodation = Accommodations::with('chaletSections.images', 'chaletSections.video', 'chaletSections.features', 'chaletSections.reservations', 'chaletSections.reviews.user')->findOrFail($id);
            
            foreach ($accommodation->chaletSections as $section) {
                $section->location = $accommodation->location;
                $section->reservations = $accommodation->reservations;
            }
    
            return response()->json($accommodation->chaletSections);
        }
    
        $accommodation = Accommodations::with('rooms.reviews.user', 'rooms.images', 'rooms.reservations')->findOrFail($id);
    
        $rooms = $accommodation->rooms->map(function ($room) {
            return [
                'id' => $room->id,
                'room_number' => $room->room_number,
                'accommodation_id' => $room->accommodation_id,
                'bedsNumber' => $room->bedsNumber,
                'roomsNumber' => $room->roomsNumber,
                'floor' => $room->floor,
                'price' => $room->price,
                'description' => $room->description,
                'category' => $room->category,
                'is_available' => $room->is_available,
                'created_at' => $room->created_at,
                'updated_at' => $room->updated_at,
                'bookingConditions' => $room->bookingConditions,
                'cancellingConditions' => $room->cancellingConditions,
                'images' => $room->images,
                'reservations' => $room->reservations,
                'reviews' => $room->reviews->map(function ($review) {
                    return [
                        'id' => $review->id,
                        'username' => $review->user->name,
                        'rating' => $review->rating,
                        'comment' => $review->comment,
                        'created_at' => $review->created_at,
                        'updated_at' => $review->updated_at,
                    ];
                }),
            ];
        });
    
        return response()->json($rooms);
    }
    
    public function availableRooms($id)
    {
        $accommodation = Accommodations::find($id);

        if (!$accommodation) {
            return response()->json(['message' => 'Accommodation not found'], 404);
        }

        return response()->json($accommodation->availableRooms);
    }

    public function reviews($id)
    {
        $accommodation = Accommodations::find($id);

        if (!$accommodation) {
            return response()->json(['message' => 'Accommodation not found'], 404);
        }

        return response()->json($accommodation->reviews);
    }

    public function features($id)
    {
        $accommodation = Accommodations::find($id);

        if (!$accommodation) {
            return response()->json(['message' => 'Accommodation not found'], 404);
        }

        return response()->json($accommodation->features);
    }

    public function accommodationsByCity($city_id)
    {
        $accommodation = Accommodations::where('city_id', $city_id)->get();

        if (!$accommodation) {
            return response()->json(['message' => 'Accommodation not found'], 404);
        }

        return response()->json($accommodation);
    }

    public function storeReview(StoreReviewRequest $request, $id)
    {


        $accommodation = Accommodations::find($id);

        if (!$accommodation) {
            return response()->json(['message' => 'Accommodation not found'], 404);
        }

        // Create the review
        $review = new Review([
            'user_id' => $request->user()->id, 
            'accommodation_id' => $accommodation->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $review->save();

        return response()->json($review, 201);
    }
}
