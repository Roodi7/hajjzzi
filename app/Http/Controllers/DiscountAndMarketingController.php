<?php

namespace App\Http\Controllers;

use App\Models\Attachments;
use App\Models\DiscountAndMarketing;
use Auth;
use Illuminate\Http\Request;

class DiscountAndMarketingController extends Controller
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
        $discountAndMarketing = DiscountAndMarketing::firstOrFail();
        $firstColumn = Attachments::where('entity_type', 'firstColumn')->get();
        $secondColumn = Attachments::where('entity_type', 'secondColumn')->get();
        $thirdColumn = Attachments::where('entity_type', 'thirdColumn')->get();
        $fourthColumn = Attachments::where('entity_type', 'fourthColumn')->get();

        return view('discount_and_marketing.index', [
            'discountAndMarketing' => $discountAndMarketing,
            'firstColumn' => $firstColumn,
            'secondColumn' => $secondColumn,
            'thirdColumn' => $thirdColumn,
            'fourthColumn' => $fourthColumn,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('discount_and_marketing.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show($discountAndMarketing)
    {
        $item = DiscountAndMarketing::findOrFail($discountAndMarketing);
        return view('discount_and_marketing.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = DiscountAndMarketing::findOrFail($id);
        return view('discount_and_marketing.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'firstColumn.*' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:4048',
            'secondColumn.*' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:4048',
            'thirdColumn.*' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:4048',
            'fourthColumn.*' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:4048',
        ]);

        $discountAndMarketing = DiscountAndMarketing::firstOrNew();

        $discountAndMarketing->title = $request->input('title');
        $discountAndMarketing->description = $request->input('description');

        $columns = ['firstColumn', 'secondColumn', 'thirdColumn', 'fourthColumn'];
        foreach ($columns as $column) {
            if ($request->hasFile($column)) {
                // Delete all existing attachments for this column
                Attachments::where('entity_type', $column)->delete();

                foreach ($request->file($column) as $file) {
                    $imagePath = $file->store($column);
                    Attachments::create([
                        'entity_type' => $column,
                        'entity_id' => 1,
                        'attachment_name' => $file->getClientOriginalName(),
                        'attachment_path' => $imagePath,
                    ]);
                }
            }
        }

        $discountAndMarketing->save();

        return redirect()->route('discount_and_marketing.index')
            ->with('success', 'تم تحديث قسم الاعلانات.');
    }

    public function destroy($id)
    {
        $item = DiscountAndMarketing::findOrFail($id);
        $item->delete();

        return redirect()->route('discount_and_marketing.index')->with('success', 'Discount and Marketing item deleted successfully');
    }
}
