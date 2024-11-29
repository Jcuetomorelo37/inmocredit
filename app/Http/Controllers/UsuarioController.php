<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios);
    }

    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario);
    }

    public function store(Request $request)
    {
        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        $usuario->contraseña = Hash::make($request->contraseña);
        $usuario->fecha_registro = $request->fecha_registro;
        $usuario->id_rol = $request->id_rol;

        $usuario->save();

        return response()->json($usuario, 201);
    }
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());
        return response()->json($usuario, 200);
    }

    public function destroy($id)
    {
        Usuario::destroy($id);
        return response()->json(null, 204);
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'correo' => 'required|email',
    //         'contraseña' => 'required'
    //     ]);

    //     $usuario = Usuario::where('correo', $request->correo)->first();

    //     // if ($usuario && Hash::check($request->contraseña, $usuario->contraseña)) {
    //     //     session(['loggedIn' => true]);
    //     //     return response()->json(['message' => 'Inicio de sesión exitoso'], 200);
    //     // }
    //      if ($usuario && Hash::check($request->contraseña, $usuario->contraseña)) {
    //         session(['loggedIn' => true]);
    //         return response()->json(['message' => 'Inicio de sesión exitoso'], 200);
    //     }

    //     return response()->json(['error' => 'Credenciales incorrectas'], 401);
    // }
    public function login(Request $request)
    {
        // Validar datos de entrada
        $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required'
        ]);

        // Convertir correo a minúsculas para evitar problemas de mayúsculas
        $correo = strtolower($request->correo);

        // Buscar usuario
        $usuario = Usuario::where('correo', $correo)->first();

        // Depurar: verificar si el usuario se encuentra
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Verificar contraseña
        if (Hash::check($request->contraseña, $usuario->contraseña)) {
            session(['loggedIn' => true]); // Establecer sesión
            return response()->json(['message' => 'Inicio de sesión exitoso'], 200);
        }

        return response()->json(['error' => 'Contraseña incorrecta'], 401);
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('5login')->with('message', 'Sesión cerrada exitosamente');
    }
}
