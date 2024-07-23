<?php

namespace App\Http\Controllers;

use App\Models\AccomdationTerms;
use App\Models\Accommodations;
use App\Models\Terms;
use Auth;
use Illuminate\Http\Request;

class AddTermController extends Controller
{

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
        if (!Auth::user()->permissions->accomodation_index) {
            if (Auth::user()->managedAccommodations->id != $accommodation->id && !Auth::user()->permissions->accomodation_index) {
                return abort(403);
            }
        }
        $terms = Terms::whereDoesntHave('accommodations', function ($query) use ($accommodation_id) {
            $query->where('accommodations.id', $accommodation_id);
        })->get();

        $accommodationterms = $accommodation->terms()->get([
            'accomdation_terms.id as id',
            'terms.name as name',
            'terms.description as description,',
        ]);

        return view('accomodation.add_term', [
            'accommodation' => $accommodation,
            'terms' => $terms,
            'accommodationterms' => $accommodationterms,
        ]);
    }
    public function accommodationAddTerm(Request $request)
    {
        try {
            // 
            foreach ($request->term_id as $term_id) {
                AccomdationTerms::create([
                    'accommodation_id' => $request->accommodation_id,
                    'term_id' => $term_id,
                ]);
            }
            session()->flash('success', 'تم الاضافة بنجاح');
            return redirect(route('accommodation.add_term', $request->accommodation_id));
        } catch (\Throwable $th) {
            return abort(500);

        }

    }

    public function accommodationDeleteTerm($accommodation_term_id)
    {
        try {
            AccomdationTerms::find($accommodation_term_id)->delete();
            session()->flash('success', 'تم حذف الشرط بنجاح');
            return redirect()->back();
        } catch (\Throwable $th) {
            return abort(500);
        }
    }
}
