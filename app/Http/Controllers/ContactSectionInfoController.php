<?php

namespace App\Http\Controllers;

use App\Models\Attachments;
use App\Models\ContactSectionInfo;
use Auth;
use Illuminate\Http\Request;
use Storage;

class ContactSectionInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function index()
    {
        $contactSections = ContactSectionInfo::all();
        return view('contactSectionInfo.index', compact('contactSections'));
    }

    public function create()
    {
        // return view('contactSectionInfo.create');
    }

    public function store(Request $request)
    {
        // $data = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'required|string',
        // ]);

        // ContactSectionInfo::create($data);

        // return redirect()->route('contactSectionInfo.index')->with('success', 'Contact Section created successfully.');
    }

    public function show(ContactSectionInfo $contactSectionInfo)
    {
        // return view('contactS/ectionInfo.show', compact('contactSectionInfo'));
    }

    public function edit(ContactSectionInfo $contactSectionInfo)
    {
        return view('contactSectionInfo.edit', compact('contactSectionInfo'));
    }

    public function update(Request $request, ContactSectionInfo $contactSectionInfo)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $contactSectionInfo->update($data);

        if ($request->hasFile('images')) {
            // delete old images
            // Delete old images from storage and database
            $contactSectionInfo->images()->get()->each(function ($attachment) {
                Storage::delete($attachment->attachment_path);
                $attachment->delete();
            });
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('footer_section');
                Attachments::create([
                    'entity_type' => 'footer_section',
                    'entity_id' => $contactSectionInfo->id,
                    'attachment_name' => $image->getClientOriginalName(),
                    'attachment_path' => $imagePath,
                ]);
            }
        }

        return redirect()->route('contactSectionInfo.index')->with('success', 'Contact Section updated successfully.');
    }

    public function destroy(ContactSectionInfo $contactSectionInfo)
    {
        // $contactSectionInfo->delete();

        // return redirect()->route('contactSectionInfo.index')->with('success', 'Contact Section deleted successfully.');
    }
}
