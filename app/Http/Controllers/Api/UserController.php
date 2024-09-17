<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['department', 'lab'])->get();
        return response()->json([
            'message' => 'Users retrieved successfully',
            'data' => [
                'users' => $users,
            ],
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string',
            'password' => 'required|string|min:8',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'lab_id' => 'required|exists:labs,id',
            'image' => 'nullable|image|max:2048',
            'fcm_token' => 'nullable|string',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('user_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $user = User::create($validatedData);

        return response()->json([
            'message' => 'User created successfully',
            'data' => [
                'user' => $user->load(['department', 'lab']),
            ],
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            'message' => 'User retrieved successfully',
            'data' => [
                'user' => $user->load(['department', 'lab']),
            ],
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'string',
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'date_of_birth' => 'date',
            'gender' => 'string',
            'address' => 'string',
            'phone' => 'string',
            'department_id' => 'exists:departments,id',
            'lab_id' => 'exists:labs,id',
            'image' => 'nullable|image|max:2048',
            'fcm_token' => 'nullable|string',
        ]);

        if ($request->has('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('user_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $user->update($validatedData);

        return response()->json([
            'message' => 'User updated successfully',
            'data' => [
                'user' => $user->fresh()->load(['department', 'lab']),
            ],
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ], 200);
    }
}
