<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;


class CartController extends Controller
{
    public function index()
    {
        // Obtener los productos del carrito (puedes usar sesiones o una tabla en la base de datos)
        $cart = session()->get('cart', []);

        return Inertia::render('Cart/Index', [
            'cart' => $cart
        ]);
    }

    public function add(Request $request)
    {
        // Lógica para agregar productos al carrito
        $product = $request->all(); // Asegúrate de validar los datos

        $cart = session()->get('cart', []);

        // Agregar el producto al carrito
        $cart[$product['id']] = $product;

        // Guardar carrito en sesión
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    public function remove($id)
    {
        // Eliminar un producto del carrito
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }
}
