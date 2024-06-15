<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;

class BookingsController extends Controller
{
    //Muestra una lista de las reservas.
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 200);

        $bookings = Bookings::paginate($limit, ['*'], 'page', $page);
        return response()->json($bookings, 200);
    }

    //Almacena una nueva reserva.
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:bookings,id',
            'booking_date' => 'required|date',
            'num_diners' => 'required|integer|min:1',
            'booking_state' => 'required|string',
        ]);

        $booking = Bookings::create($request->all());
        return response()->json($booking, 201);
    }

    //Muestra la reserva especificada.
    public function show($id)
    {
        $booking = Bookings::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        return response()->json($booking, 200);
    }

    //Actualiza la reserva especificada.
    public function update(Request $request, $id)
    {
        $booking = Bookings::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $request->validate([
            'id_user' => 'exists:users,id',
            'booking_date' => 'date',
            'num_diners' => 'integer|min:1',
            'booking_state' => 'string',
        ]);

        $booking->update($request->all());
        return response()->json($booking, 200);
    }

    //Elimina la reserva especificada.
    public function destroy($id)
    {
        $booking = Bookings::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $booking->delete();
        return response()->json(null, 204);
    }
}
