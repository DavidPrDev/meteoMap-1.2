<?php

namespace App\Http\Controllers;

use App\Services\CodigoMunicipioService;

use Illuminate\Http\Request;

class CodigoMunicipioController
{
    protected $mapaDataService;

    public function __construct(CodigoMunicipioService $mapaDataService)
    {
        $this->mapaDataService = $mapaDataService;
    }


    public function index()
    {
        $arrayComunidades = config('ComunidadesConstants');

        $arrayOutput = $this->mapaDataService->obtenerDatosMeteorologicos($arrayComunidades);

        return view('index', compact('arrayOutput'));
    }


    public function getMunicipio($id)
    {
        $municipio = $this->mapaDataService->getMunicipio($id);

        return response()->json($municipio);
    }


    public function autocomplete($query)
    {
        $municipios = $this->mapaDataService->autocomplete($query);

        return response()->json($municipios);
    }
}
