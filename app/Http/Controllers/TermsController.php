<?php

namespace App\Http\Controllers;

use App\Http\Requests\Term\StoreTermRequest;
use App\Http\Requests\Term\UpdateTermRequest;
use App\Models\Terms;
use Illuminate\Http\Request;
use Auth;
use Storage;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->permissions->term_index) {

            $search_Lvl = "";
            if ($request->query('search_Lvl') != null) {
                $search_Lvl = $request->input('search_Lvl');
                $terms = Terms::where('id', '=', $search_Lvl)
                    ->orWhere('name', 'LIKE', '%' . $search_Lvl . '%')
                    ->orderBy('id', 'DESC')
                    ->paginate(25)
                    ->withQueryString();
            } else {
                $terms = terms::orderBy('terms.id', 'DESC')
                    ->paginate(25);
            }

            return view('terms.index')->with('terms', $terms)
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
        if (!Auth::user()->permissions->term_create) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
        }
        return view('terms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTermRequest $request)
    {
        $term = new Terms();
        $term->name = $request->name;
        $term->description = $request->description;
        $term->save();
        session()->flash('success', 'تم حفظ معلومات الشرط بنجاح');
        return redirect()->route('term.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Terms $term)
    {
        if (!Auth::user()->permissions->term_delete) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
        }
        try {
            return view('terms.show')->with('term', $term);
        } catch (\Throwable $th) {
            abort(500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Terms $term)
    {
        if (!Auth::user()->permissions->term_edit) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
        }
        return view('terms.edit')->with('term', $term);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTermRequest $request, Terms $term)
    {
        //
        try {
            $term->name = $request->name;
            $term->description = $request->description;
            $term->save();

            session()->flash('success', 'تم تحديث معلومات الشرط بنجاح');
            return redirect()->route('term.index');
        } catch (\Throwable $th) {
            return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Terms $term)
    {
        if (!Auth::user()->permissions->term_delete) {
            session()->flash('dont access', ' ليس لديك سماحية الوصول الى هذه الصفحة  ');
            return abort(403);
        }
        try {
            if ($term->accommodations()->count() != 0) {
                session()->flash('delete', 'لا يمكن حذف الشرط لانه مرتبط بمساكن');
                return redirect()->back();

            }
            session()->flash('success', 'تم حذف ' . $term->name . ' بنجاح');
            $term->delete();
            return redirect()->route('term.index');

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
