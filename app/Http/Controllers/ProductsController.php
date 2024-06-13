<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    //Muestra una lista de todos los productos.     
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 200);

        $products = Products::paginate($limit, ['*'], 'page', $page);
        return response()->json($products, 200);
    }

    //Almacena un nuevo producto en la base de datos.     
    public function store(Request $request)
    {
        $request->validate([
            'name_product' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'string|nullable',
            'category' => 'string|nullable',
            'image' => 'string|nullable',
        ]);

        $product = Products::create($request->all());
        return response()->json($product, 201);
    }

    //Muestra el producto especificado.     
    public function show($id)
    {
        $product = Products::findOrFail($id);
        return response()->json($product);
    }

    //Actualiza el producto especificado en la base de datos.
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_product' => 'string',
            'price' => 'numeric',
            'description' => 'string|nullable',
            'category' => 'string|nullable',
            'image' => 'string|nullable',
        ]);

        $product = Products::findOrFail($id);
        $product->update($request->all());
        return response()->json($product, 200);
    }

    //Elimina el producto especificado de la base de datos.
    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
}
