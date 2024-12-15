<?php

namespace App\Http\Controllers;

use App\Models\ReservasiModel;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    // Mendapatkan semua reservasi pengguna
    public function getReservations(Request $request)
    {
        $user = $request->user();
        $reservations = ReservasiModel::where('user_id', $user->id)
            ->with(['car'])
            ->get();

        return response()->json($reservations, 200);
    }

    // Memberikan review (contoh)
    public function giveReview(Request $request, $id)
    {
        $validatedData = $request->validate([
            'review' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Logika untuk menyimpan review (misal di tabel ReviewModel)
        // ReviewModel::create([...]);

        return response()->json(['message' => 'Review submitted successfully'], 200);
    }
}
