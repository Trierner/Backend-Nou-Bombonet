<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservas;

class ReservasController extends Controller
{
    //Muestra una lista de las reservas.
    public function index()
    {
        $reservas = Reservas::all();
        return response()->json($reservas, 200);
    }

    //Almacena una nueva reserva.
    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:users,id',
            'fecha_hora_reserva' => 'required|date',
            'numero_comensales' => 'required|integer|min:1',
            'estado_reserva' => 'required|string',
        ]);

        $reserva = Reservas::create($request->all());
        return response()->json($reserva, 201);
    }

    //Muestra la reserva especificada.
    public function show($id)
    {
        $reserva = Reservas::find($id);

        if (!$reserva) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }

        return response()->json($reserva, 200);
    }

    //Actualiza la reserva especificada.
    public function update(Request $request, $id)
    {
        $reserva = Reservas::find($id);

        if (!$reserva) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }

        $request->validate([
            'id_cliente' => 'exists:users,id',
            'fecha_hora_reserva' => 'date',
            'numero_comensales' => 'integer|min:1',
            'estado_reserva' => 'string',
        ]);

        $reserva->update($request->all());
        return response()->json($reserva, 200);
    }

    //Elimina la reserva especificada.
    public function destroy($id)
    {
        $reserva = Reservas::find($id);

        if (!$reserva) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }

        $reserva->delete();
        return response()->json(null, 204);
    }
}
