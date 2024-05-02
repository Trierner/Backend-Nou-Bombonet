<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;

class ProductosController extends Controller
{
    //Muestra una lista de todos los productos.     
    public function index()
    {
        $productos = Productos::all();
        return response()->json($productos);
    }

    //Almacena un nuevo producto en la base de datos.     
    public function store(Request $request)
    {
        $request->validate([
            'nombre_producto' => 'required|string',
            'precio' => 'required|numeric',
            'descripcion' => 'string|nullable',
            'categoria' => 'string|nullable',
            'imagen' => 'string|nullable',
        ]);

        $producto = Productos::create($request->all());
        return response()->json($producto, 201);
    }

    //Muestra el producto especificado.     
    public function show($id)
    {
        $producto = Productos::findOrFail($id);
        return response()->json($producto);
    }

    //Actualiza el producto especificado en la base de datos.
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_producto' => 'string',
            'precio' => 'numeric',
            'descripcion' => 'string|nullable',
            'categoria' => 'string|nullable',
            'imagen' => 'string|nullable',
        ]);

        $producto = Productos::findOrFail($id);
        $producto->update($request->all());
        return response()->json($producto, 200);
    }

    //Elimina el producto especificado de la base de datos.
    public function destroy($id)
    {
        $producto = Productos::findOrFail($id);
        $producto->delete();
        return response()->json(null, 204);
    }
}
