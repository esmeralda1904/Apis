<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Multa;
use App\Events\NuevaMulta;

class MultaController extends Controller
{
    public function index($departamento)
    {
        return Multa::where('departamento', $departamento)
                    ->orderBy('fecha', 'desc')
                    ->get();
    }

    public function store(Request $request)
    {
        $multa = Multa::create($request->all());
        broadcast(new NuevaMulta($multa))->toOthers();
        return response()->json($multa);
    }
}
