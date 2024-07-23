<?php

namespace App\Http\Controllers;

use App\Http\Requests\Accomodation\UpdateAccomodationRequest;
use App\Models\Accommodations;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Models\City;
use App\Http\Requests\Accomodation\StoreAccomodationRequest;
use App\Models\Attachments;
use Auth;
use Storage;

class AccommodationsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (
                !(Auth::user()->permissions->accomodation_index ||
                    Auth::user()->permissions->accomodation_create ||
                    Auth::user()->permissions->accomodation_edit ||
                    Auth::user()->permissions->accomodation_delete)
                &&
                !Auth::user()->managedAccommodations
            ) {
                session()->flash('dont access', 'ليس لديك سماحية الوصول الى هذه الصفحة');
                return abort(403);
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public
    $accomodations_type = [
        'hotel' => 'فندق',
        'chalet' => 'شاليه',
        'hall' => 'صالة',
        'appartment' => 'شقة',
    ];

    public function index(Request $request, $type)
    {

        if (!Auth::user()->permissions->accomodation_index && (!Auth::user()->managedAccommodations || Auth::user()->managedAccommodations()->first()->type != $type)) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
        }
        // dd();
        $show_type = [
            'hotel' => 'hotels',
            'chalet' => 'chalets',
            'hall' => 'halls',
            'appartment' => 'appartments',
        ];
        // dd($show_type);
        $search_Lvl = "";
        if ($request->query('search_Lvl') != null) {
            $search_Lvl = $request->input('search_Lvl');
            $cities = Accommodations::where('id', '=', $search_Lvl)
                ->orWhere('name', 'LIKE', '%' . $search_Lvl . '%')
                ->orderBy('id', 'DESC')
                ->paginate(25)
                ->withQueryString();
        } else {
            $accomodations = Accommodations::join('cities', 'accommodations.city_id', '=', 'cities.id');
            if (in_array($show_type[$type], ['hotels', 'chalets', 'halls', 'appartments'])) {
                $accomodations = Accommodations::query()->{$show_type[$type]}()
                    ->join('cities', 'accommodations.city_id', '=', 'cities.id');
            }
        }
        if (Auth::user()->role == "manager") {
            $accomodations->join('users', 'accommodations.manager_id', 'users.id')->where('users.id', Auth::user()->id);
        }
        $accomodations = $accomodations->orderBy('accommodations.id', 'DESC')
            ->paginate(25, [
                'accommodations.id as id',
                'accommodations.name as name',
                'accommodations.type as type',
                'accommodations.city_id',
                'cities.city_name as city_name'
            ]);
        $accomodations_type = $this->accomodations_type;

        return view('accomodation.index')->with('accomodations', $accomodations)
            ->with('accomodations_type', $accomodations_type)
            ->with('type', $type)
            ->with('search_Lvl', $search_Lvl);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($type)
    {
        if (!Auth::user()->permissions->accomodation_create && (!Auth::user()->managedAccommodations || Auth::user()->managedAccommodations()->first()->type != $type)) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة');
            return abort(403);
        }

        $cities = City::orderBy('id', 'DESC')
            ->get(['id', 'city_name']);
        $accomodations_type = $this->accomodations_type;

        return view('accomodation.create')
            ->with('accomodations_type', $accomodations_type)
            ->with('type', $type)
            ->with('users', User::all())
            ->with('cities', $cities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccomodationRequest $request)
    {
        // dd($request);
        $accomodation = new Accommodations();
        $accomodation->name = $request->name;
        $accomodation->city_id = $request->city_id;
        $accomodation->type = $request->type;
        $accomodation->price = $request->price;
        $accomodation->location = $request->location;
        $accomodation->capacity = $request->capacity;
        $accomodation->short_description = $request->short_description;
        $accomodation->description = $request->description;
        $accomodation->longitude = $request->longitude;
        $accomodation->latitude = $request->latitude;
        $accomodation->phone = $request->phone;
        $accomodation->rating = $request->rating;
        $accomodation->notes = $request->notes;
        $accomodation->bookingConditions = $request->bookingConditions;
        $accomodation->cancellingConditions = $request->cancellingConditions;
        $accomodation->save();


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('accomodation');
                Attachments::create([
                    'entity_type' => 'accomodation',
                    'entity_id' => $accomodation->id,
                    'attachment_name' => $image->getClientOriginalName(),
                    'attachment_path' => $imagePath,
                ]);
            }
        }
        if ($request->has('video_url') && $request->video_url != "") {

            $vid = Video::create([
                'accommodation_id' => $accomodation->id,
                'url' => $request->video_url,
            ]);
        }
        return redirect()->route('accomodations.index', $request->type);
    }

    /**
     * Display the specified resource.
     */
    public function show(Accommodations $accommodations, $accommodation)
    {
        $accommodation = Accommodations::find($accommodation);
        if (!Auth::user()->permissions->accomodation_delete && !Auth::user()->managedAccommodations) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
        }

        $accomodations_type = $this->accomodations_type;

        $cities = City::orderBy('id', 'DESC')
            ->get(['id', 'city_name']);
        return view('accomodation.show')
            ->with('accomodations_type', $accomodations_type)
            ->with('cities', $cities)
            ->with('accommodation', $accommodation);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($accommodation)
    {
        $accommodation = Accommodations::find($accommodation);

        if (!Auth::user()->permissions->accomodation_edit && (!Auth::user()->managedAccommodations || Auth::user()->managedAccommodations()->first()->type != $accommodation->type)) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
        }
        $accomodations_type = $this->accomodations_type;

        $cities = City::orderBy('id', 'DESC')
            ->get(['id', 'city_name']);
        return view('accomodation.edit')
            ->with('accomodations_type', $accomodations_type)
            ->with('cities', $cities)
            ->with('accommodation', $accommodation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccomodationRequest $request, $accommodations)
    {
        $accommodation = Accommodations::find($accommodations);
        $accommodation->name = $request->name;
        $accommodation->city_id = $request->city_id;
        $accommodation->type = $request->type;
        $accommodation->price = $request->price;
        $accommodation->location = $request->location;
        $accommodation->capacity = $request->capacity;
        $accommodation->short_description = $request->short_description;
        $accommodation->description = $request->description;
        $accommodation->notes = $request->notes;
        $accommodation->longitude = $request->longitude;
        $accommodation->latitude = $request->latitude;
        $accommodation->bookingConditions = $request->bookingConditions;
        $accommodation->cancellingConditions = $request->cancellingConditions;
        $accommodation->save();

        if ($request->hasFile('images')) {
            // delete old images
            // Delete old images from storage and database
            $accommodation->attachments()->get()->each(function ($attachment) {
                Storage::delete($attachment->attachment_path);
                $attachment->delete();
            });
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('accomodation');
                Attachments::create([
                    'entity_type' => 'accomodation',
                    'entity_id' => $accommodation->id,
                    'attachment_name' => $image->getClientOriginalName(),
                    'attachment_path' => $imagePath,
                ]);
            }
        }

        if ($request->has('video_url') && $request->video_url != "") {
            $old_vid = Video::where('accommodation_id', $accommodation->id);
            if ($old_vid) {
                $old_vid->delete();
            }
            $vid = Video::create([
                'accommodation_id' => $accommodation->id,
                'url' => $request->video_url,
            ]);
        }
        session()->flash('success', 'تم حفظ معلومات المسكن بنجاح');
        return redirect()->route('accomodations.index', $request->type);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accommodations $accommodations, $accommodation)
    {
        //
        if (!Auth::user()->permissions->accomodation_delete && !Auth::user()->managedAccommodations) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
        }
        $accommodation = Accommodations::find($accommodation);
        $accommodation_name = $accommodation->name;
        $accommodation_type = $accommodation->type;
        $accommodation->attachments()->get()->each(function ($attachment) {
            Storage::delete($attachment->attachment_path);
            $attachment->delete();
        });
        session()->flash('success', 'تم حذف المسكن ' . $accommodation_name . ' بنجاح');

        $accommodation->delete();
        return redirect()->route('accomodations.index', $accommodation_type);
    }
}
