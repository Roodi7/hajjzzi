<?php


namespace App\Http\Controllers;

use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $items = PrivacyPolicy::all();
        return view('privacy_policy.index', compact('items'));
    }

    public function create()
    {
        return view('privacy_policy.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        PrivacyPolicy::create($request->all());

        return redirect()->route('privacy-policy.index')->with('success', 'Privacy Policy created successfully');
    }

    public function show($id)
    {
        $item = PrivacyPolicy::findOrFail($id);
        return view('privacy_policy.show', compact('item'));
    }

    public function edit($id)
    {
        $item = PrivacyPolicy::findOrFail($id);
        return view('privacy_policy.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $item = PrivacyPolicy::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('privacy-policy.index')->with('success', 'Privacy Policy updated successfully');
    }

    public function destroy($id)
    {
        $item = PrivacyPolicy::findOrFail($id);
        $item->delete();

        return redirect()->route('privacy-policy.index')->with('success', 'Privacy Policy deleted successfully');
    }
}
