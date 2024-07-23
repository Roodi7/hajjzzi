<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feature\StoreFeatureRequest;
use App\Http\Requests\Feature\UpdateFeatureRequest;
use App\Models\Attachments;
use App\Models\Features;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->permissions->feature_index) {

            $search_Lvl = "";
            if ($request->query('search_Lvl') != null) {
                $search_Lvl = $request->input('search_Lvl');
                $features = Features::where('id', '=', $search_Lvl)
                    ->orWhere('name', 'LIKE', '%' . $search_Lvl . '%')
                    ->orderBy('id', 'DESC')
                    ->paginate(25)
                    ->withQueryString();
            } else {
                $features = Features::orderBy('features.id', 'DESC')
                    ->paginate(25);
            }

            return view('feature.index')->with('features', $features)
                ->with('search_Lvl', $search_Lvl);
        } else {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);

        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->permissions->feature_create) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
        }
        return view('feature.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeatureRequest $request)
    {
        $feature = new Features();
        $feature->name = $request->name;
        $feature->rating = $request->rating;
        $feature->description = $request->description;
        $feature->notes = $request->notes;
        $feature->save();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('features');
                Attachments::create([
                    'entity_type' => 'feature',
                    'entity_id' => $feature->id,
                    'attachment_name' => $image->getClientOriginalName(),
                    'attachment_path' => $imagePath,
                ]);
            }
        }
        session()->flash('success', 'تم حفظ معلومات الميزة بنجاح');
        return redirect()->route('feature.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Features $feature)
    {
        //
        if (!Auth::user()->permissions->feature_delete) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
        }
        try {
            return view('feature.show')->with('feature', $feature);
        } catch (\Throwable $th) {
            abort(500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Features $feature)
    {
        if (!Auth::user()->permissions->feature_edit) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
        }
        return view('feature.edit')->with('feature', $feature);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeatureRequest $request, Features $feature)
    {
        //
        try {
            $feature->name = $request->name;
            $feature->rating = $request->rating;
            $feature->description = $request->description;
            $feature->notes = $request->notes;
            $feature->save();
            if ($request->hasFile('images')) {
                $feature->attachments()->get()->each(function ($attachment) {
                    Storage::delete($attachment->attachment_path);
                    $attachment->delete();
                });
                foreach ($request->file('images') as $image) {

                    $imagePath = $image->store('features');
                    Attachments::create([
                        'entity_type' => 'feature',
                        'entity_id' => $feature->id,
                        'attachment_name' => $image->getClientOriginalName(),
                        'attachment_path' => $imagePath,
                    ]);
                }
            }
            session()->flash('success', 'تم تحديث معلومات الميزة بنجاح');
            return redirect()->route('feature.index');
        } catch (\Throwable $th) {
            return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Features $feature)
    {
        if (!Auth::user()->permissions->feature_delete) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
        }
        try {
            if ($feature->accommodations()->count() != 0) {
                session()->flash('delete', 'لا يمكن حذف الشرط لانه مرتبط بمساكن');
                return redirect()->back();

            }
            $feature->attachments()->get()->each(function ($attachment) {
                Storage::delete($attachment->attachment_path);
                $attachment->delete();
            });
            session()->flash('success', 'تم حذف ' . $feature->name . ' بنجاح');
            $feature->delete();
            return redirect()->route('feature.index');

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
