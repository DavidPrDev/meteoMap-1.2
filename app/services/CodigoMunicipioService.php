<?php

namespace App\Services;

use App\Models\CodigoMunicipio;
use App\Models\DataApi;
use App\Validators\EstadoCieloValidator;
use Illuminate\Support\Facades\Http;

class CodigoMunicipioService
{
    public function obtenerDatosMeteorologicos($arrayComunidades)
    {
        $registro = DataApi::first();

        $data = $registro->json;
        $tiempo = $registro->time;

        $split = explode(':', $tiempo);
        $horaUltimaActualizacion = intval($split[0]);

        $horaActual = intval(date("H"));
        $diferenciaHoras = $horaActual - $horaUltimaActualizacion;

        if ($diferenciaHoras >= 6) {

            $arrayOutput = [];

            foreach ($arrayComunidades as $comunidad) {

                $urlBase = "https://opendata.aemet.es/opendata/api/prediccion/especifica/municipio/diaria/" . $comunidad['Codigo'] . "/?api_key=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJob21hMDBwdW5rQGdtYWlsLmNvbSIsImp0aSI6ImY1MWM5MTc5LTY2MDgtNDkxYi1hZmFmLWMzYWMxM2Y1MWRiMSIsImlzcyI6IkFFTUVUIiwiaWF0IjoxNzAxMjYyNTg4LCJ1c2VySWQiOiJmNTFjOTE3OS02NjA4LTQ5MWItYWZhZi1jM2FjMTNmNTFkYjEiLCJyb2xlIjoiIn0.Rv-xLe8mCxIlnwnYHyVT21QO1PVi-vRhJCv-MMXsxB8";


                $response = Http::get($urlBase);

                $data = json_decode($response, true);


                $urlDetella = $data['datos'];
                $jsonParte = Http::get($urlDetella);

                $parteDiario = iconv('ISO-8859-1', 'UTF-8//IGNORE', $jsonParte);


                $jsonDecodeParte = json_decode($parteDiario, true);

                $primerDia = $jsonDecodeParte[0]['prediccion']['dia'][0];

                $horaActual = intval(date("H"));
                $icono = "";
                if ($horaActual < 6 && $horaActual >= 0) {

                    $icono = EstadoCieloValidator::validarEstado($primerDia, 3);
                } else if ($horaActual < 12 && $horaActual >= 6) {
                    $icono = EstadoCieloValidator::validarEstado($primerDia, 4);
                } else if ($horaActual < 18 && $horaActual >= 12) {
                    $icono = EstadoCieloValidator::validarEstado($primerDia, 5);
                } else if ($horaActual < 24 && $horaActual >= 18) {
                    $icono = EstadoCieloValidator::validarEstado($primerDia, 6);
                }


                $arrayOutput[] = [
                    "Nombre" => $comunidad['Nombre'],
                    "Codigo" => $comunidad['Codigo'],
                    "estadoCielo" => $icono
                ];
            }
            DataApi::truncate();
            DataApi::create(['json' => json_encode($arrayOutput), 'time' => date("H:i:s")]);

            return response()->json($arrayOutput);
        } else {
            return response()->json(json_decode($data, true));
        }
    }

    public function getMunicipio($id)
    {

        $urlBase = "https://opendata.aemet.es/opendata/api/prediccion/especifica/municipio/diaria/" . $id . "/?api_key=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJob21hMDBwdW5rQGdtYWlsLmNvbSIsImp0aSI6ImY1MWM5MTc5LTY2MDgtNDkxYi1hZmFmLWMzYWMxM2Y1MWRiMSIsImlzcyI6IkFFTUVUIiwiaWF0IjoxNzAxMjYyNTg4LCJ1c2VySWQiOiJmNTFjOTE3OS02NjA4LTQ5MWItYWZhZi1jM2FjMTNmNTFkYjEiLCJyb2xlIjoiIn0.Rv-xLe8mCxIlnwnYHyVT21QO1PVi-vRhJCv-MMXsxB8";

        $response = Http::get($urlBase);

        $data = json_decode($response, true);

        $urlDetella = $data['datos'];
        $jsonParte = Http::get($urlDetella);

        $parteDiario = iconv('ISO-8859-1', 'UTF-8//IGNORE', $jsonParte);

        $jsonDecodeParte = json_decode($parteDiario, true);
        $primerDia = $jsonDecodeParte[0]['prediccion']['dia'][0];

        $tempMax = $primerDia['temperatura']["maxima"];
        $tempMin = $primerDia['temperatura']["minima"];

        $porbLluviaVal0012 = $primerDia['probPrecipitacion'][1]["value"];
        $porbLluviaVal1224 = $primerDia['probPrecipitacion'][1]["value"];

        $icono12 = EstadoCieloValidator::validarEstado($primerDia, 4);
        $icono24 = EstadoCieloValidator::validarEstado($primerDia, 6);

        $vientoDir = $primerDia['viento'][0]["direccion"];
        $vientoVel = $primerDia['viento'][0]["velocidad"];

        $totalData = [
            "tempMax" => $tempMax,
            "tempMin" => $tempMin,
            "probLl12" => $porbLluviaVal0012,
            "probLl24" => $porbLluviaVal1224,
            "icono12" => $icono12,
            "icono24" => $icono24,
            "vientoDir" => $vientoDir,
            "vientoVel" => $vientoVel
        ];
        return response()->json($totalData);
    }

    public function autocomplete($query)
    {

        $municipios = CodigoMunicipio::where('nombre', 'LIKE', "$query%")
            ->get(['nombre', 'codigo']);

        return response()->json($municipios);
    }
}
