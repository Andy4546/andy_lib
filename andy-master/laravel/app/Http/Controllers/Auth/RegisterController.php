<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'id_number' => 'required|size:7|unique:users', // Add this line
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'type' => 'required|in:librarian,borrower,librarian-aide',
            'contact' => 'required|string|unique:users',
        ]);

        // Create a new user
        $user = User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'id_number' => 'required|size:7|unique:users', // Add this line
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'type' => $validatedData['type'],
            'contact' => $validatedData['contact'],
        ]);

        // Return the user data as a response
        return response()->json($user);
    }
}