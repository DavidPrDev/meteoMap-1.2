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
        return view('index');
    }

    public function getComunidades()
    {
        $arrayComunidades = config('ComunidadesConstants');

        $arrayOutput = $this->mapaDataService->obtenerDatosMeteorologicos($arrayComunidades);

        return response()->json($arrayOutput);
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
