<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedidos;

class PedidosController extends Controller
{
    //Muestra una lista de los recursos.
    public function index()
    {
        $pedidos = Pedidos::all();
        return response()->json($pedidos, 200);
    }

    //Almacena un recurso recién creado en el almacenamiento.
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'fecha_hora_pedido' => 'required|date',
            'estado_pedido' => 'required',
            'total' => 'required|numeric|min:0',
            'para_llevar' => 'required|boolean',
        ]);

        $pedido = Pedidos::create($request->all());
        return response()->json($pedido, 201);
    }

    //Muestra el recurso especificado.
    public function show($id)
    {
        $pedido = Pedidos::find($id);

        if (!$pedido) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }

        return response()->json($pedido, 200);
    }

    //Actualiza el recurso especificado en el almacenamiento.
    public function update(Request $request, $id)
    {
        $pedido = Pedidos::find($id);

        if (!$pedido) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }

        $request->validate([
            'id_user' => 'exists:users,id',
            'fecha_hora_pedido' => 'date',
            'estado_pedido' => 'string',
            'total' => 'numeric|min:0',
            'para_llevar' => 'boolean',
        ]);

        $pedido->update($request->all());
        return response()->json($pedido, 200);
    }

    //Elimina el recurso especificado del almacenamiento.
    public function destroy($id)
    {
        $pedido = Pedidos::find($id);

        if (!$pedido) {
            return response()->json(['message' => 'Pedidos no encontrado'], 404);
        }

        $pedido->delete();
        return response()->json(null, 204);
    }
}
