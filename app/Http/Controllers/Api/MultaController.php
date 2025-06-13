<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Multa;
use App\Events\NuevaMulta;

class MultaController extends Controller
{
    // Obtener las multas por departamento
    public function index($departamento)
    {
        return Multa::where('departamento', $departamento)
                    ->orderBy('fecha', 'desc')
                    ->get();
    }

    // Guardar una nueva multa
    public function store(Request $request)
    {
        // Validación básica para evitar datos vacíos o inválidos
        $request->validate([
            'departamento' => 'required|string',
            'motivo' => 'required|string',
            'monto' => 'required|numeric|min:0',
            'fecha' => 'required|date',
        ]);

        // Crear multa
        $multa = Multa::create($request->all());

        // Enviar evento de broadcast (sin ->toOthers() si el cliente no lo creó)
        broadcast(new NuevaMulta($multa));

        // Devolver respuesta con código 201 (creado)
        return response()->json($multa, 201);
    }
}
