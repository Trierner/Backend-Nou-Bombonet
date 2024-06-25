<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;

class OrdersController extends Controller
{
    //Muestra una lista de todos los pedidos.
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 200);

        $orders = Orders::paginate($limit, ['*'], 'page', $page);
        return response()->json($orders, 200);
    }

    //Almacena un nuevo pedido en la base de datos.
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'date' => 'required|date',
            'state' => 'required',
            'total' => 'required|numeric|min:0',
            'carry' => 'required|boolean',
        ]);

        $order = Orders::create($request->all());
        return response()->json($order, 201);
    }

    //Muestra el pedido especificado.
    public function show($id)
    {
        $order = Orders::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order, 200);
    }

    //Muestra el pedido por el id de usuario.
    public function showByUser($id_user)
    {
        $order = Orders::where('id_user', $id_user)->get();

        if ($order->isEmpty()) {
            return response()->json(['message' => 'No orders found for this user'], 404);
        }

        return response()->json($order, 200);
    }

    //Actualiza el pedido especificado en la base de datos.
    public function update(Request $request, $id)
    {
        $order = Orders::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $request->validate([
            'id_user' => 'exists:users,id',
            'date' => 'date',
            'state' => 'string',
            'total' => 'numeric|min:0',
            'carry' => 'boolean',
        ]);

        $order->update($request->all());
        return response()->json($order, 200);
    }

    //Elimina el pedido especificado de la base de datos.
    public function destroy($id)
    {
        $order = Orders::find($id);

        if (!$order) {
            return response()->json(['message' => 'Orders no encontrado'], 404);
        }

        $order->delete();
        return response()->json(null, 204);
    }
}
