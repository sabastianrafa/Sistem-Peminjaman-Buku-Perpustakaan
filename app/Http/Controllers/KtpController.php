<?php

namespace App\Http\Controllers;

use App\Models\Ktp;
use Illuminate\Http\Request;

class KtpController extends Controller
{
    public function index()
    {
        $ktps = Ktp::all();
        return response()->json($ktps);
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|string|unique:ktp',
            'nama_user' => 'required|string',
            'alamat' => 'required|string'
        ]);

        $ktp = Ktp::create([
            'no_ktp' => $request->no_ktp,
            'nama_user' => $request->nama_user,
            'alamat' => $request->alamat,
            'status_validasi' => 'pending'
        ]);

        return response()->json($ktp, 201);
    }

    public function updateValidation(Request $request, $id)
    {
        $request->validate([
            'status_validasi' => 'required|in:pending,valid,invalid'
        ]);

        $ktp = Ktp::find($id);
        
        if (!$ktp) {
            return response()->json(['message' => 'KTP not found'], 404);
        }

        $ktp->update([
            'status_validasi' => $request->status_validasi
        ]);

        return response()->json($ktp);
    }
}