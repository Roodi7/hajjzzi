<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMainServiceRequest;
use App\Models\MainPageServices;
use Auth;
use Illuminate\Http\Request;

class MainPageServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->permissions->manage_mainpage) {
            return abort(403, 'ليس لديك سماحية الوصول الى هذه الصفحة');
        }
        $services = MainPageServices::all();
        return view('mainServices.index', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->permissions->manage_mainpage) {
            return abort(403, 'ليس لديك سماحية الوصول الى هذه الصفحة');

        }
        return view('mainServices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMainServiceRequest $request)
    {
        try {
            $mainService = new MainPageServices();
            $mainService->title = $request->title;
            $mainService->description = $request->description;
            $mainService->save();
            session()->flash('success', 'تم الاضافة بنجاح');
            return redirect(route('main-services.index'));
        } catch (\Throwable $th) {
            abort(500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MainPageServices $mainPageServices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MainPageServices $mainPageServices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MainPageServices $mainPageServices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($mainPageServices)
    {
        if (!Auth::user()->permissions->manage_mainpage) {
            return abort(403, 'ليس لديك سماحية الوصول الى هذه الصفحة');
        }
        try {
            $mainPageServices = MainPageServices::find($mainPageServices);

            $mainPageServices->delete();
            session()->flash('success', 'تم الحذف بنجاح');
            return redirect(route('main-services.index'));
        } catch (\Throwable $th) {
            abort(500);
        }
    }
}
