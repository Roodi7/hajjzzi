<?php


namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        $items = Policy::all();
        return view('policy.index', compact('items'));
    }

    public function create()
    {
        return view('policy.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Policy::create($request->all());

        return redirect()->route('policy.index')->with('success', 'Policy created successfully');
    }

    public function show($id)
    {
        $item = Policy::findOrFail($id);
        return view('policy.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Policy::findOrFail($id);
        return view('policy.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $item = Policy::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('policy.index')->with('success', 'Policy updated successfully');
    }

    public function destroy($id)
    {
        $item = Policy::findOrFail($id);
        $item->delete();

        return redirect()->route('policy.index')->with('success', 'Policy deleted successfully');
    }
}
