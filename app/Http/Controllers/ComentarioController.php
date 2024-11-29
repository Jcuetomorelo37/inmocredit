<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;

class ComentarioController extends Controller
{
    public function index()
    {
        return response()->json(Comentario::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_arrendatario' => 'required|string|max:45',
            'comentario' => 'required|string|max:45',
            'publicante' => 'required|string|max:45',
        ]);
    
        $comentario = Comentario::create($request->all());
        return response()->json($comentario);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'comentario' => 'required|string|max:100',
        ]);
    
        $comentario = Comentario::find($id);
        if ($comentario) {
            $comentario->update($request->all());
            return response()->json($comentario);
        }
    
        return response()->json(['error' => 'Comentario no encontrado'], 404);
    }
    

    public function destroy($id)
    {
        $comentario = Comentario::find($id);
        $comentario->delete();
        return response()->json(['message' => 'Comentario eliminado.']);
    }

    public function show($id)
    {
        $comentario = Comentario::find($id);

        if (!$comentario) {
            return response()->json(['error' => 'Comentario no encontrado'], 404);
        }

        return response()->json($comentario); // Asegúrate de que esté en formato JSON
    }
}
