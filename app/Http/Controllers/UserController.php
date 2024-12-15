<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Mendapatkan data profil pengguna
    public function getProfile(Request $request)
    {
        $user = $request->user(); // Mendapatkan pengguna saat ini dari JWT
        return response()->json($user, 200);
    }

    // Memperbarui data profil pengguna
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        // Validasi data input, tanpa password
        $validatedData = $request->validate([
            'nama_user' => 'string|max:255',
            'email' => 'string|email|max:255|unique:user,email,' . $user->id,
            'phone_number' => 'string|max:15',
            'alamat' => 'string|max:500',
        ]);

        // Update profil pengguna
        try {
            $user->update($validatedData);
            return response()->json(['message' => 'Profile updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Profile update failed', 'message' => $e->getMessage()], 500);
        }
    }
}

