<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Inertia\Inertia;
use Iluminate\Support\Facades\storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::with('images')->paginate(10); // Carga las imágenes asociadas
        return inertia('Productos/Index', ['productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Productos/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        // Almacena la imagen
        $imagePath = $request->file('imagen')->store('productos', 'public');

        // Crea el nuevo producto
        Producto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'imagen' => $imagePath,
        ]);

        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function detalle($id)
    {
        // Obtener el producto junto con sus imágenes
        $producto = Producto::with('images')->findOrFail($id);

        return inertia('Productos/Detalle', ['producto' => $producto]);
    }
}
