<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\StoreReviewRequest;
use App\Models\Accommodations;
use App\Models\ChaletSection;
use App\Models\Review;
use App\Models\Room;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function storeReview(StoreReviewRequest $request)
    {
        // Create the review
        $review = new Review([
            'user_id' => $request->user_id,
            'entity_type' => $request->entity_type,
            'entity_id' => $request->entity_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $review->save();

        return response()->json($review, 201);
    }

    public function index(Request $request)
    {
        $accommodations = Accommodations::all();
        $query = Review::with(['user']);

        if ($request->has('user_name') && $request->input('user_name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('user_name') . '%');
            });
        }

        if ($request->has('accommodation_check') && $request->input('accommodation_check')) {
            $accommodationId = $request->input('accommodation_search');
            $query->where(function ($q) use ($accommodationId) {
                $q->where(function ($q) use ($accommodationId) {
                    $q->where('entity_type', 'accommodation')->where('entity_id', $accommodationId);
                })->orWhere(function ($q) use ($accommodationId) {
                    $q->whereHas('room.accommodation', function ($q) use ($accommodationId) {
                        $q->where('id', $accommodationId);
                    });
                })->orWhere(function ($q) use ($accommodationId) {
                    $q->whereHas('chaletSection.accommodation', function ($q) use ($accommodationId) {
                        $q->where('id', $accommodationId);
                    });
                });
            });
        }

        if ($request->has('date_search_check') && $request->input('date_search_check')) {
            if ($request->has('from_date')) {
                $query->where('created_at', '>=', $request->input('from_date'));
            }
            if ($request->has('to_date')) {
                $query->where('created_at', '<=', $request->input('to_date'));
            }
        }

        $reviews = $query->paginate(25)->withQueryString();

        $reviews->each(function ($review) {
            if ($review->entity_type == 'accommodation') {
                $review->entity = Accommodations::find($review->entity_id);
            } elseif ($review->entity_type == 'room') {
                $review->entity = Room::find($review->entity_id);
            } elseif ($review->entity_type == 'chalet_section') {
                $review->entity = ChaletSection::find($review->entity_id);
            }
        });

        return view('reviews.index', compact('reviews', 'accommodations'));
    }

    public function destroy(Review $review)
    {
        $review->delete();

        session()->flash('success', 'تم الحذف بنجاح');
        return redirect(route('reviews.index'));
    }

}
