<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Book;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'book'])->get();
        return response()->json($bookings);
    }

    public function userBookings(Request $request)
    {
        $bookings = Booking::with('book')
            ->where('id_user', $request->user()->id_user)
            ->get();

        return response()->json($bookings);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:books,id_buku',
            'jumlah_buku' => 'required|integer|min:1'
        ]);

        $book = Book::find($request->id_buku);

        if ($book->stok < $request->jumlah_buku) {
            return response()->json([
                'message' => 'Stok buku tidak mencukupi'
            ], 400);
        }

        // Kurangi stok buku
        $book->decrement('stok', $request->jumlah_buku);

        $booking = Booking::create([
            'id_user' => $request->user()->id_user,
            'id_buku' => $request->id_buku,
            'jumlah_buku' => $request->jumlah_buku,
            'tanggal' => now(),
            'status_booking' => 'pending'
        ]);

        return response()->json($booking, 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_booking' => 'required|in:pending,approved,rejected,completed'
        ]);

        $booking = Booking::find($id);
        
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $booking->update([
            'status_booking' => $request->status_booking
        ]);

        return response()->json($booking);
    }

    public function destroy($id)
    {
        $booking = Booking::find($id);
        
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        // Kembalikan stok buku
        $booking->book->increment('stok', $booking->jumlah_buku);

        $booking->delete();

        return response()->json(['message' => 'Booking deleted successfully']);
    }
}