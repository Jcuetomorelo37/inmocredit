<?php

namespace App\Http\Controllers;

use App\Models\HistorialPago;
use Illuminate\Http\Request;

class HistorialPagoController extends Controller
{
    public function index()
    {
        $historial = HistorialPago::with('inquilino', 'propiedad')->get();  // Carga la relación 'inquilino' (Usuario)
        
        // Transformar los resultados para incluir el nombre del inquilino en lugar del id
        $historialConNombres = $historial->map(function($item) {
            return [
                'id' => $item->id,
                'id_inquilino' => $item->id_inquilino,
                'nombre_inquilino' => $item->inquilino->nombre,  // Obtener el nombre del inquilino
                'fecha_inicio_fin' => $item->fecha_inicio_fin,
                'valoracion' => $item->valoracion,
                'observaciones' => $item->observaciones,
                'afectaciones_materiales' => $item->afectaciones_materiales,
                'propiedad' => $item->propiedad,
                
            ];
        });
    
        return response()->json($historialConNombres);
    }
    

    public function show($id)
    {
        $historial = HistorialPago::findOrFail($id);
        return response()->json($historial);
    }

    public function store(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'id_inquilino' => 'required|string|exists:usuarios,nombre',
            'fecha_inicio_fin' => 'required|string',
            'valoracion' => 'required|integer|min:1|max:5',
            'observaciones' => 'nullable|string',
            'afectaciones_materiales' => 'nullable|string',
            'propiedad' => 'required|string|exists:propiedades,direccion',
        ]);
    
        // Obtener el ID del inquilino a partir del nombre
        $idInquilino = \App\Models\Usuario::where('nombre', $validated['id_inquilino'])->first()->id_usuario;
    
        // Obtener el ID de la propiedad a partir de la dirección
        $idPropiedad = \App\Models\Propiedad::where('direccion', $validated['propiedad'])->first()->id_propiedad;
    
        // Crear el historial de pago con los IDs correspondientes
        $historial = HistorialPago::create([
            'id_inquilino' => $idInquilino,
            'fecha_inicio_fin' => $validated['fecha_inicio_fin'],
            'valoracion' => $validated['valoracion'],
            'observaciones' => $validated['observaciones'] ?? null,
            'afectaciones_materiales' => $validated['afectaciones_materiales'] ?? null,
            'propiedad' => $idPropiedad,
        ]);
    
        return response()->json($historial, 201);
    }
    
    


    public function update(Request $request, $id)
    {
        $historial = HistorialPago::findOrFail($id);
        $historial->update($request->all());
        return response()->json($historial, 200);
    }

    public function destroy($id)
    {
        HistorialPago::destroy($id);
        return response()->json(null, 204);
    }
}
