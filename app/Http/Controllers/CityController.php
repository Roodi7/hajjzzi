<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\Attachments;
use App\Models\City;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        if (Auth::user()->permissions->city_index) {

            $search_Lvl = "";
            if ($request->query('search_Lvl') != null) {
                $search_Lvl = $request->input('search_Lvl');
                $cities = City::where('id', '=', $search_Lvl)
                    ->orWhere('city_name', 'LIKE', '%' . $search_Lvl . '%')
                    ->orderBy('id', 'DESC')
                    ->paginate(25, ['id', 'city_name'], 'page')
                    ->withQueryString();
            } else {
                $cities = City::orderBy('id', 'DESC')
                    ->paginate(25, ['id', 'city_name', 'details'], 'page');
            }

            return view('city.index')->with('cities', $cities)->with('search_Lvl', $search_Lvl);
        } else {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
            ;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->permissions->city_create) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
        }

        return view('city.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request)
    {
        //
        $city = new City();
        $city->city_name = $request->city_name;
        $city->details = $request->details;
        $city->description = $request->description;
        $city->notes = $request->notes;
        $city->save();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('cities');
                Attachments::create([
                    'entity_type' => 'city',
                    'entity_id' => $city->id,
                    'attachment_name' => $image->getClientOriginalName(),
                    'attachment_path' => $imagePath,
                ]);
            }
        }
        session()->flash('success', 'تم حفظ معلومات المدينة بنجاح');
        return redirect()->route('city.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        if (!Auth::user()->permissions->city_delete) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
        }
        return view('city.show', ['city' => $city]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        if (!Auth::user()->permissions->city_edit) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
        }
        return view('city.edit', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        $city->city_name = $request->city_name;
        $city->details = $request->details;
        $city->description = $request->description;
        $city->notes = $request->notes;
        $city->save();
        if ($request->hasFile('images')) {
            // delete old images
            $city->attachments()->get()->each(function ($attachment) {
                Storage::delete($attachment->attachment_path);
                $attachment->delete();
            });
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('cities');
                Attachments::create([
                    'entity_type' => 'city',
                    'entity_id' => $city->id,
                    'attachment_name' => $image->getClientOriginalName(),
                    'attachment_path' => $imagePath,
                ]);
            }
        }
        session()->flash('success', 'تم حفظ معلومات المدينة بنجاح');
        return redirect()->route('city.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, City $city)
    {
        if (!Auth::user()->permissions->city_delete) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
        }
        if ($city->accommodations()->count() > 0) {
            return redirect()->back()->withErrors(['count' => ' لا يمكن حذف المدينة ' . $city->city_name . ' لوجود مساكن مرتبطة بها']);

        }
        // delete old images
        $city->attachments()->get()->each(function ($attachment) {
            Storage::delete($attachment->attachment_path);
            $attachment->delete();
        });
        session()->flash('success', 'تم حذف المدينة ' . $city->city_name . ' بنجاح');

        $city->delete();
        return redirect()->route('city.index');

    }
}
