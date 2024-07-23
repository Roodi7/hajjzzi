<?php

namespace App\Http\Controllers;

use App\Models\Accommodations;
use App\Models\Permission;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class ManageUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->permissions->manage_users) {
                session()->flash('dont access', 'ليس لديك سماحية الوصول الى هذه الصفحة');
                return abort(403);
            }
            return $next($request);
        });
    }
    //
    public function index()
    {
        $users = User::where('role', 'admin')->get();
        return view('auth.index', compact('users'));
    }
    public function create()
    {
        return view('auth.register');
    }
    public function managers()
    {
        $users = User::where('role', 'manager')->join('accommodations', 'users.id', 'accommodations.manager_id')
            ->select(['users.*', 'accommodations.name as accommodation_name'])->get();
        return view('auth.managers', compact('users'));
    }
    public function allUsers(Request $request)
    {
        $users = User::whereNotNull('id');

        if ($request->has('user_name')) {
            $users = $users->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->user_name . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->user_name . '%');
            });
        }

        $users = $users->paginate(25)->withQueryString();
        return view('auth.all_users', compact('users'));

    }

    public function accommodationManagerCreate()
    {
        $accommodations = Accommodations::leftJoin('users', 'users.id', 'accommodations.manager_id')
            ->whereNull('accommodations.manager_id')
            ->select(['accommodations.id as id', 'accommodations.name as name'])
            ->get();
        return view('auth.register_manager', ['accommodations' => $accommodations]);
    }
    public function accommodationManagerPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'accommodation_id' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'manager',
        ]);
        $permissions = Permission::create([
            'user_id' => $user->id,
            'accomodation_edit' => 1,
        ]);
        $accommodation = Accommodations::find($request->accommodation_id);
        $accommodation->update([
            'manager_id' => $user->id,
        ]);

        return redirect()->route('user.managers')->with('success', 'تم انشاء المستخدم.');
    }

    public function edit($user)
    {
        $user = User::find($user);
        $permissions = $user->permissions;
        return view('auth.edit', compact('user', 'permissions'));

    }

    //create user
    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);
        $permissions = Permission::create([
            'user_id' => $user->id,
        ]);
        // Assign roles or permissions based on checkboxes
        if ($request->has('manage_cities')) {
            $permissions->update([
                'city_index' => 1,
                'city_create' => 1,
                'city_edit' => 1,
                'city_delete' => 1,
            ]);
        }

        if ($request->has('manage_accomodations')) {
            $permissions->update([
                'accomodation_index' => 1,
                'accomodation_create' => 1,
                'accomodation_edit' => 1,
                'accomodation_delete' => 1,
            ]);
        }

        if ($request->has('manage_featuers')) {
            $permissions->update([
                'feature_index' => 1,
                'feature_create' => 1,
                'feature_edit' => 1,
                'feature_delete' => 1,
            ]);
        }

        if ($request->has('manage_terms')) {
            $permissions->update([
                'term_index' => 1,
                'term_create' => 1,
                'term_edit' => 1,
                'term_delete' => 1,
            ]);
        }

        if ($request->has('manage_mainpage')) {
            $permissions->update([
                'manage_mainpage' => 1,
            ]);
        }

        if ($request->has('manage_users')) {
            $permissions->update([
                'manage_users' => 1,
                'manage_mails' => 1,
            ]);
        }

        return redirect()->route('user.index')->with('success', 'تم انشاء المستخدم.');
    }


    public function update(Request $request, $id)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Find the user
        $user = User::findOrFail($id);

        // Update the user's information
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        // Find or create the permissions
        $permissions = Permission::firstOrNew(['user_id' => $user->id]);

        // Reset permissions
        $permissions->fill([
            'city_index' => 0,
            'city_create' => 0,
            'city_edit' => 0,
            'city_delete' => 0,
            'accomodation_index' => 0,
            'accomodation_create' => 0,
            'accomodation_edit' => 0,
            'accomodation_delete' => 0,
            'feature_index' => 0,
            'feature_create' => 0,
            'feature_edit' => 0,
            'feature_delete' => 0,
            'term_index' => 0,
            'term_create' => 0,
            'term_edit' => 0,
            'term_delete' => 0,
            'manage_mainpage' => 0,
            'manage_users' => 0,
            'manage_mails' => 0,
        ]);

        // Assign roles or permissions based on checkboxes
        if ($request->has('manage_cities')) {
            $permissions->update([
                'city_index' => 1,
                'city_create' => 1,
                'city_edit' => 1,
                'city_delete' => 1,
            ]);
        }

        if ($request->has('manage_accomodations')) {
            $permissions->update([
                'accomodation_index' => 1,
                'accomodation_create' => 1,
                'accomodation_edit' => 1,
                'accomodation_delete' => 1,
            ]);
        }

        if ($request->has('manage_featuers')) {
            $permissions->update([
                'feature_index' => 1,
                'feature_create' => 1,
                'feature_edit' => 1,
                'feature_delete' => 1,
            ]);
        }

        if ($request->has('manage_terms')) {
            $permissions->update([
                'term_index' => 1,
                'term_create' => 1,
                'term_edit' => 1,
                'term_delete' => 1,
            ]);
        }

        if ($request->has('manage_mainpage')) {
            $permissions->update([
                'manage_mainpage' => 1,
            ]);
        }

        if ($request->has('manage_users')) {
            $permissions->update([
                'manage_users' => 1,
                'manage_mails' => 1,
            ]);
        }

        // Save permissions
        $permissions->save();

        return redirect()->route('user.index')->with('success', 'تم تحديث المستخدم بنجاح.');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $permissions = Permission::where('user_id', $id)->first();
        $permissions->delete();

        $user->delete();
        return redirect()->route('user.index')->with('success', 'تم حذف المستخدم بنجاح.');
    }
    public function managerDestroy($id)
    {
        $user = User::findOrFail($id);
        $permissions = Permission::where('user_id', $id)->first();
        $permissions->delete();
        $accommodation = Accommodations::where('manager_id', $id)->first();
        if ($accommodation) {
            $accommodation->update([
                'manager_id' => null,
            ]);
        }


        $user->delete();
        return redirect()->route('user.managers')->with('success', 'تم حذف المستخدم بنجاح.');
    }
}
