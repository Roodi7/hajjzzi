<?php

namespace App\Http\Controllers;

use App\Models\Accommodations;
use App\Models\Attachments;
use App\Models\ChaletSection;
use App\Models\Video;
use Illuminate\Http\Request;
use Auth;

class ChaletSectionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->permissions->accomodation_index && (!Auth::user()->managedAccommodations)) {
                session()->flash('dont access', 'ليس لديك سماحية الوصول الى هذه الصفحة');
                return abort(403);
            }
            return $next($request);
        });
    }

    public function index($accommodation)
    {
        $accommodation = Accommodations::find($accommodation);

        if (Auth::user()->role != "admin") {

            if (!Auth::user()->permissions->accomodation_index && Auth::user()->managedAccommodations->id != $accommodation->id) {
                session()->flash('dont access', 'ليس لديك سماحية الوصول الى هذه الصفحة');
                return abort(403);
            }
        }
        $chaletSections = $accommodation->ChaletSections()->get([
            'chalet_sections.id as id',
            'chalet_sections.description as description',
            'chalet_sections.name as name',
            'chalet_sections.numberOfRooms as numberOfRooms',
            'chalet_sections.pricePerNight as pricePerNight',
            'chalet_sections.numberOfStars as numberOfStars',
            'chalet_sections.latitude as latitude',
            'chalet_sections.longitude as longitude',
            'chalet_sections.accommodation_id as accommodation_id',
        ]);

        return view('chaletSection.index', [
            'accommodation' => $accommodation,
            'chaletSections' => $chaletSections,
        ]);

    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'accommodation_id' => 'required|exists:accommodations,id',
            'numberOfRooms' => 'integer',
            'pricePerNight' => 'numeric',
            'numberOfStars' => 'integer',
            'description' => 'string',
            'latitude' => 'string',
            'longitude' => 'string',
            'bookingConditions' => 'string',
            'cancellingConditions' => 'string',
        ]);

        $section = ChaletSection::create($validated);


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('chalet_section');
                Attachments::create([
                    'entity_type' => 'chalet_section',
                    'entity_id' => $section->id,
                    'attachment_name' => $image->getClientOriginalName(),
                    'attachment_path' => $imagePath,
                ]);
            }
        }
        if ($request->has('video_url') && $request->video_url != "") {
            Video::create([
                'chalet_section_id' => $section->id,
                'url' => $request->video_url,
            ]);
        }


        return redirect()->route('chalet_section.create', $request->accommodation_id)->with('success', 'تم انشاء الجناح ضمن الشاليه.');
    }

    public function destroy($id)
    {
        $section = ChaletSection::findOrFail($id);
        $section->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح.');
    }
}
