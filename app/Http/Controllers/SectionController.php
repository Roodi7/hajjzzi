<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Auth;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->permissions->manage_mainpage) {
                session()->flash('dont access', 'ليس لديك سماحية الوصول الى هذه الصفحة');
                return abort(403);
            }
            return $next($request);
        });
    }
    public function edit()
    {
        $section = Section::first();
        return view('sections.edit', compact('section'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hotels_description' => 'nullable|string',
            'hotels_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'chalets_description' => 'nullable|string',
            'chalets_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'halls_description' => 'nullable|string',
            'halls_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'appartments_description' => 'nullable|string',
            'appartments_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $section = Section::first();

        if ($request->hasFile('hotels_image')) {
            $hotels_image = $request->file('hotels_image')->store('images', 'public');
        } else {
            $hotels_image = $section->hotels_image;
        }

        if ($request->hasFile('chalets_image')) {
            $chalets_image = $request->file('chalets_image')->store('images', 'public');
        } else {
            $chalets_image = $section->chalets_image;
        }

        if ($request->hasFile('halls_image')) {
            $halls_image = $request->file('halls_image')->store('images', 'public');
        } else {
            $halls_image = $section->halls_image;
        }

        if ($request->hasFile('appartments_image')) {
            $appartments_image = $request->file('appartments_image')->store('images', 'public');
        } else {
            $appartments_image = $section->appartments_image;
        }

        $section->update([
            'hotels_description' => $request->hotels_description,
            'hotels_image' => $hotels_image,
            'chalets_description' => $request->chalets_description,
            'chalets_image' => $chalets_image,
            'halls_description' => $request->halls_description,
            'halls_image' => $halls_image,
            'appartments_description' => $request->appartments_description,
            'appartments_image' => $appartments_image,
        ]);

        return redirect()->back()->with('success', 'تم تعديل وصف الاقسام بنجاح.');
    }
}
