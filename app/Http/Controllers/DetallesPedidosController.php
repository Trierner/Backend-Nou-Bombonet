<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetallesPedidos;

class DetallesPedidosController extends Controller
{
    //Muestra una lista de los detalles de pedidos.
    public function index()
    {
        $detallesPedidos = DetallesPedidos::all();
        return response()->json($detallesPedidos, 200);
    }

    //Almacena un nuevo detalle de pedido.
    public function store(Request $request)
    {
        $request->validate([
            'id_pedido' => 'required|exists:pedidos,id',
            'id_producto' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'especificaciones' => 'nullable|string',
        ]);

        $detallePedido = DetallesPedidos::create($request->all());
        return response()->json($detallePedido, 201);
    }

    //Muestra el detalle de pedido especificado.
    public function show($id)
    {
        $detallePedido = DetallesPedidos::find($id);

        if (!$detallePedido) {
            return response()->json(['message' => 'Detalle de pedido no encontrado'], 404);
        }

        return response()->json($detallePedido, 200);
    }

    //Actualiza el detalle de pedido especificado.    
    public function update(Request $request, $id)
    {
        $detallePedido = DetallesPedidos::find($id);

        if (!$detallePedido) {
            return response()->json(['message' => 'Detalle de pedido no encontrado'], 404);
        }

        $request->validate([
            'id_pedido' => 'exists:pedidos,id',
            'id_producto' => 'exists:productos,id',
            'cantidad' => 'integer|min:1',
            'precio_unitario' => 'numeric|min:0',
            'especificaciones' => 'nullable|string',
        ]);

        $detallePedido->update($request->all());
        return response()->json($detallePedido, 200);
    }

    //Elimina el detalle de pedido especificado.
    public function destroy($id)
    {
        $detallePedido = DetallesPedidos::find($id);

        if (!$detallePedido) {
            return response()->json(['message' => 'Detalle de pedido no encontrado'], 404);
        }

        $detallePedido->delete();
        return response()->json(null, 204);
    }
}
