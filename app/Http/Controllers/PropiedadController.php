<?php

namespace App\Http\Controllers;

use App\Models\Propiedad;
use Illuminate\Http\Request;

class PropiedadController extends Controller
{
    public function index()
    {
        $propiedades = Propiedad::all();
        return response()->json($propiedades);
    }

    public function show($id)
    {
        $propiedad = Propiedad::findOrFail($id);
        return response()->json($propiedad);
    }
    public function store(Request $request)
    {
        // Validar y crear una nueva propiedad
        $request->validate([
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'estado' => 'required|string|max:50',
            'id_propietario' => 'nullable|integer'
        ]);

        $propiedad = Propiedad::create($request->all());
        return response()->json($propiedad, 201);
    }

    public function update(Request $request, $id)
    {
        // Buscar la propiedad y actualizar sus datos
        $request->validate([
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'estado' => 'required|string|max:50',
            'id_propietario' => 'nullable|integer'
        ]);

        $propiedad = Propiedad::find($id);

        if (!$propiedad) {
            return response()->json(['error' => 'Propiedad no encontrada'], 404);
        }

        $propiedad->update($request->all());
        return response()->json($propiedad, 200);
    }

    public function destroy($id)
    {
        $propiedad = Propiedad::find($id);

        if (!$propiedad) {
            return response()->json(['error' => 'Propiedad no encontrada'], 404);
        }

        $propiedad->delete();
        return response()->json(['message' => 'Propiedad eliminada'], 200);
    }
}
