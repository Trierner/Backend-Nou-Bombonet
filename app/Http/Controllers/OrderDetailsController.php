<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\DB;

class OrderDetailsController extends Controller
{
    //Muestra una lista de los detalles de pedidos.
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 200);

        $orderDetails = OrderDetails::paginate($limit, ['*'], 'page', $page);
        return response()->json($orderDetails, 200);
    }

    //Almacena un nuevo detalle de pedido.
    public function store(Request $request)
    {
        $request->validate([
            'id_order' => 'required|exists:orders,id',
            'id_product' => 'required|exists:products,id',
            'amount' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'specs' => 'nullable|string',
        ]);

        $orderDetail = OrderDetails::create($request->all());
        return response()->json($orderDetail, 201);
    }

    //Muestra el detalle de pedido especificado.
    public function show($id)
    {
        $orderDetail = OrderDetails::find($id);

        if (!$orderDetail) {
            return response()->json(['message' => 'Order detail not found'], 404);
        }

        return response()->json($orderDetail, 200);
    }

    //Muestra el detalle de pedido por el id del pedido
    public function showDetail($id_order)
    {
        $orderDetail = DB::table('order_details')
            ->leftJoin('products', 'order_details.id_product', '=', 'products.id')
            ->select(
                'order_details.id',
                'order_details.id_order',
                'order_details.id_product',
                'order_details.amount',
                'order_details.unit_price',
                'order_details.specs',
                'products.name_product',
                'products.description',
                'products.price',
                'products.category',
                'products.image'
            )
            ->where('order_details.id_order', $id_order)
            ->get();

        if ($orderDetail->isEmpty()) {
            return response()->json(['message' => 'Order detail not found'], 404);
        }

        return response()->json($orderDetail, 200);
    }

    //Actualiza el detalle de pedido especificado.    
    public function update(Request $request, $id)
    {
        $orderDetail = OrderDetails::find($id);

        if (!$orderDetail) {
            return response()->json(['message' => 'Order detail not found'], 404);
        }

        $request->validate([
            'id_pedido' => 'exists:orders,id',
            'id_product' => 'exists:products,id',
            'amount' => 'integer|min:1',
            'unit_price' => 'numeric|min:0',
            'specs' => 'nullable|string',
        ]);

        $orderDetail->update($request->all());
        return response()->json($orderDetail, 200);
    }

    //Elimina el detalle de pedido especificado.
    public function destroy($id)
    {
        $orderDetail = OrderDetails::find($id);

        if (!$orderDetail) {
            return response()->json(['message' => 'Order detail not found'], 404);
        }

        $orderDetail->delete();
        return response()->json(null, 204);
    }
}
