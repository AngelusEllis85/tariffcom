<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return Inertia::render('Users/Index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', Password::defaults()],
        ]);
    
        $user = User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), 
        ]);
    
        return response()->json(['user' => $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return Inertia::render('Users/Show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return Inertia::render('Users/Edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $validatedData = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => ['required', Password::defaults()],
        ]);

        // Update the user with the validated data
        $user->update([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json();
    }

    public function trashed()
    {
        $trashedUsers = User::onlyTrashed()->get();
        return Inertia::render('Users/Trashed', ['trashedUsers' => $trashedUsers]);
    }

    public function restore(string $id)
    {
        $user = User::onlyTrashed()->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->restore();
        return response()->json();
    }        
    
    public function forceDelete(string $id)
    {                           
        $user = User::onlyTrashed()->find($id);
        $user->forceDelete();
        return response()->json();
    }                                           
}
