<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __invoke(Request $request)
    {
        // Lógica del controlador aquí
        return response()->json(['mensaje' => 'Hola desde el método __invoke']);
    }
    
    public function login(Request $request)
    {
        return response('Hello World', 200)
        ->header('Content-Type', 'text/plain');
    }

    public function test(Request $request)
    {
        return response()->json(['mensaje' => 'Hola desde el métod test']);

    }
    
    public function logout(Request $request)
    {
        // Lógica de cierre de sesión aquí
    }

    public function register(Request $request)
    {
        return response()->json(['mensaje' => $request->input('email')]);

    }
}
