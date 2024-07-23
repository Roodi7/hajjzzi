<?php

namespace App\Http\Controllers;

use App\Models\AccomdationFeature;
use App\Models\Accommodations;
use App\Models\ChaletSection;
use App\Models\ChaletSectionFeatures;
use App\Models\Features;
use App\Models\Room;
use App\Models\RoomFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddFeatureController extends Controller
{
    //
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

        $accommodation_id = $accommodation->id;
        if (!Auth::user()->permissions->accomodation_index ) {
            if (Auth::user()->managedAccommodations->id != $accommodation->id && !Auth::user()->permissions->accomodation_index) {
                return abort(403);
            }
        }

        $features = Features::whereDoesntHave('accommodations', function ($query) use ($accommodation_id) {
            $query->where('accommodations.id', $accommodation_id);
        })->get();

        $accommodationFeatures = $accommodation->features()->get([
            'accomdation_features.id as id',
            'features.name as name',
            'features.description as description as description,',
        ]);

        return view('accomodation.add_feature', [
            'accommodation' => $accommodation,
            'features' => $features,
            'accommodationFeatures' => $accommodationFeatures,
        ]);
    }
    public function accommodationAddFeature(Request $request)
    {
        try {

            foreach ($request->feature_id as $feature_id) {
                AccomdationFeature::create([
                    'accommodation_id' => $request->accommodation_id,
                    'feature_id' => $feature_id,
                ]);
            }
            session()->flash('success', 'تم الاضافة بنجاح');
            return redirect()->back();
        } catch (\Throwable $th) {
            return abort(500);

        }

    }
    public function accommodationDeleteFeature($accommodation_featuer_id)
    {
        try {
            AccomdationFeature::find($accommodation_featuer_id)->delete();

            session()->flash('success', 'تم حذف الميزة بنجاح');
            return redirect()->back();
        } catch (\Throwable $th) {
            return abort(500);
        }
    }


    public function roomFeatures(Room $room)
    {
        $features = Features::whereDoesntHave('rooms', function ($query) use ($room) {
            $query->where('rooms.id', $room->id);
        })->get();

        $roomFeatures = $room->features()->get([
            'room_features.id as id',
            'features.name as name',
            'features.description as  description',
        ]);


        return view('room.add_feature', [
            'room' => $room,
            'features' => $features,
            'roomFeatures' => $roomFeatures,
        ]);
    }


    public function roomAddFeature(Request $request)
    {
        try {

            foreach ($request->feature_id as $feature_id) {
                RoomFeature::create([
                    'room_id' => $request->room_id,
                    'feature_id' => $feature_id,
                ]);
            }
            session()->flash('success', 'تم الاضافة بنجاح');
            return redirect()->back();
        } catch (\Throwable $th) {
            return abort(500);
        }

    }
    public function roomDeleteFeature($room_featuer_id)
    {
        try {
            RoomFeature::find($room_featuer_id)->delete();
            session()->flash('success', 'تم حذف الميزة بنجاح');
            return redirect()->back();
        } catch (\Throwable $th) {
            return abort(500);
        }
    }


    public function chaletsectionFeatures($chaletSection)
    {
        $chaletSection = ChaletSection::find($chaletSection);
        $features = Features::whereDoesntHave('chalet_sections', function ($query) use ($chaletSection) {
            $query->where('chalet_sections.id', $chaletSection->id);
        })->get();

        $chaletSectionFeatures = $chaletSection->features()->get([
            'chalet_section_features.id as id',
            'features.name as name',
            'features.description as  description',
        ]);


        return view('chaletSection.add_feature', [
            'chalet_section' => $chaletSection,
            'features' => $features,
            'chalet_sectionFeatures' => $chaletSectionFeatures,
        ]);
    }


    public function chaletsectionAddFeature(Request $request)
    {
        try {
            foreach ($request->feature_id as $feature_id) {
                ChaletSectionFeatures::create([
                    'chalet_section_id' => $request->chalet_section_id,
                    'feature_id' => $feature_id,
                ]);
            }
            session()->flash('success', 'تم الاضافة بنجاح');
            return redirect()->back();
        } catch (\Throwable $th) {
            return abort(500);
        }

    }
    public function chaletsectionDeleteFeature($chalet_section_feature_id)
    {
        try {
            ChaletSectionFeatures::find($chalet_section_feature_id)->delete();
            session()->flash('success', 'تم حذف الميزة بنجاح');
            return redirect()->back();
        } catch (\Throwable $th) {
            return abort(500);
        }
    }
}
