<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMainSliderRequest;
use App\Models\MainPageSlider;
use Auth;
use Illuminate\Http\Request;

class MainPageSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (!Auth::user()->permissions->manage_mainpage) {
            return abort(403, 'ليس لديك سماحية الوصول الى هذه الصفحة');
        }
        $slides = MainPageSlider::all();
        return view('mainSlider.index', ['slides' => $slides]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->permissions->manage_mainpage) {
            return abort(403, 'ليس لديك سماحية الوصول الى هذه الصفحة');

        }
        return view('mainSlider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMainSliderRequest $request)
    {
        //
        try {
            $mainSlider = new MainPageSlider();
            $mainSlider->title = $request->title;
            $mainSlider->description = $request->description;

            $imagePath = $request->image->store('mainSlider');
            $mainSlider->image = $imagePath;

            $mainSlider->save();
            session()->flash('success', 'تم الاضافة بنجاح');
            return redirect(route('main-slider.index'));
        } catch (\Throwable $th) {
            abort(500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(MainPageSlider $mainPageSlider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MainPageSlider $mainPageSlider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MainPageSlider $mainPageSlider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($mainPageSlider)
    {
        if (!Auth::user()->permissions->manage_mainpage) {
            return abort(403, 'ليس لديك سماحية الوصول الى هذه الصفحة');
        }
        try {
            $mainPageSlider = MainPageSlider::find($mainPageSlider);

            $mainPageSlider->delete();
            session()->flash('success', 'تم الحذف بنجاح');
            return redirect(route('main-slider.index'));
        } catch (\Throwable $th) {
            abort(500);
        }
    }
}
