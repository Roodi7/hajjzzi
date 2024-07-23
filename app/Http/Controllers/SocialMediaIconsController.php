<?php

namespace App\Http\Controllers;

use App\Models\SocialMediaIcons;
use Auth;
use Illuminate\Http\Request;

class SocialMediaIconsController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialMediaIcons = SocialMediaIcons::orderBy('order')->get();
        return view('SocialIcons.index', ['socialMediaIcons' => $socialMediaIcons]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('SocialIcons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'order' => 'integer|nullable',
        ]);

        $socialMediaIcon = new SocialMediaIcons([
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $request->icon,
            'order' => $request->order ?? 0,
        ]);

        $socialMediaIcon->save();

        session()->flash('success', 'تم الاضافة بنجاح');
        return redirect(route('social-icons.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($socialMediaIcons)
    {
        $socialMediaIcon = SocialMediaIcons::find($socialMediaIcons);

        if (!$socialMediaIcon) {
            return response()->json(['message' => 'Social Media Icon not found'], 404);
        }

        return response()->json($socialMediaIcon);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialMediaIcons $socialMediaIcons)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:255|nullable',
            'url' => 'string|max:255|nullable',
            'icon' => 'string|max:255|nullable',
            'order' => 'integer|nullable',
        ]);

        $socialMediaIcon = SocialMediaIcons::find($id);

        if (!$socialMediaIcon) {
            return response()->json(['message' => 'Social Media Icon not found'], 404);
        }

        $socialMediaIcon->name = $request->name ?? $socialMediaIcon->name;
        $socialMediaIcon->url = $request->url ?? $socialMediaIcon->url;
        $socialMediaIcon->icon = $request->icon ?? $socialMediaIcon->icon;
        $socialMediaIcon->order = $request->order ?? $socialMediaIcon->order;

        $socialMediaIcon->save();


        session()->flash('success', 'تم التحديث بنجاح');
        return redirect(route('social-icons.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($socialMediaIcons)
    {
        $socialMediaIcon = SocialMediaIcons::find($socialMediaIcons);

        if (!$socialMediaIcon) {
            return response()->json(['message' => 'Social Media Icon not found'], 404);
        }

        $socialMediaIcon->delete();

        session()->flash('success', 'تم الحذف بنجاح');
        return redirect(route('social-icons.index'));
    }
}
