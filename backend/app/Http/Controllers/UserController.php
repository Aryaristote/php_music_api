<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    // Show all users
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Show a user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Create user
    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Generate token
        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    //Update a user
    public function update(Request $request) {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'username' => 'nullable|string|max:255',
        ]);

        $user->update($validatedData);

        return response()->json(['message' => 'User updated successfully'], 200);
    }

    // Destroy method to delete an existing user
    public function delete()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
