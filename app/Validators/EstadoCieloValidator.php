<?php

namespace App\Validators;

class EstadoCieloValidator
{
    public static function validarEstado($primerDia, $num)
    {
        $icono = "";
        $estadoCielo = $primerDia['estadoCielo'][$num]["value"];
        switch ($num) {
            case 3:
                if ($estadoCielo == "") {
                    $estadoCielo = $primerDia['estadoCielo'][4]["value"];
                }
                if ($estadoCielo == "") {
                    $estadoCielo = $primerDia['estadoCielo'][5]["value"];
                }
                if ($estadoCielo == "") {
                    $estadoCielo = $primerDia['estadoCielo'][6]["value"];
                }
                break;
            case 4:
                if ($estadoCielo == "") {
                    $estadoCielo = $primerDia['estadoCielo'][5]["value"];
                }
                if ($estadoCielo == "") {
                    $estadoCielo = $primerDia['estadoCielo'][6]["value"];
                }
                if ($estadoCielo == "") {
                    $estadoCielo = $primerDia['estadoCielo'][3]["value"];
                }
                break;
            case 5:
                if ($estadoCielo == "") {
                    $estadoCielo = $primerDia['estadoCielo'][6]["value"];
                }
                if ($estadoCielo == "") {
                    $estadoCielo = $primerDia['estadoCielo'][4]["value"];
                }
                if ($estadoCielo == "") {
                    $estadoCielo = $primerDia['estadoCielo'][3]["value"];
                }
                break;
            case 6:
                if ($estadoCielo == "") {
                    $estadoCielo = $primerDia['estadoCielo'][5]["value"];
                }
                if ($estadoCielo == "") {
                    $estadoCielo = $primerDia['estadoCielo'][4]["value"];
                }
                if ($estadoCielo == "") {
                    $estadoCielo = $primerDia['estadoCielo'][3]["value"];
                }
                break;
        }
        if ($estadoCielo == "11" || $estadoCielo == "11n") {
            $icono = "soleado";
        }
        if ($estadoCielo == "13" || $estadoCielo == "13n") {
            $icono = "nubladoSol";
        }
        // 12n,14,14n,15,16n,16,16n,17,17n 
        if (
            $estadoCielo == "12n" ||
            $estadoCielo == "12" ||
            $estadoCielo == "14" ||
            $estadoCielo == "14n" ||
            $estadoCielo == "15" ||
            $estadoCielo == "15n" ||
            $estadoCielo == "16" ||
            $estadoCielo == "16n" ||
            $estadoCielo == "17" ||
            $estadoCielo == "17n" ||
            $estadoCielo == "63"
        ) {
            $icono = "nublado";
        }
        /* lluvia 
        23,24,24n,25,25n,26n,43,43n,44,44n,45n,46n */
        if (
            $estadoCielo == "23" ||
            $estadoCielo == "24" ||
            $estadoCielo == "24n" ||
            $estadoCielo == "25" ||
            $estadoCielo == "25n" ||
            $estadoCielo == "26n" ||
            $estadoCielo == "26" ||
            $estadoCielo == "43" ||
            $estadoCielo == "43n" ||
            $estadoCielo == "44" ||
            $estadoCielo == "44n" ||
            $estadoCielo == "45n" ||
            $estadoCielo == "45" ||
            $estadoCielo == "46" ||
            $estadoCielo == "46n"
        ) {
            $icono = "lluvia";
        }
        /* tormenta
        51 ,51n ,52 ,52n ,53 ,53n,54,54n,61,61n,62n,63,63n */
        if (
            $estadoCielo == "51" ||
            $estadoCielo == "51n" ||
            $estadoCielo == "52" ||
            $estadoCielo == "52n" ||
            $estadoCielo == "53" ||
            $estadoCielo == "53n" ||
            $estadoCielo == "54" ||
            $estadoCielo == "54n" ||
            $estadoCielo == "61" ||
            $estadoCielo == "61n" ||
            $estadoCielo == "62n" ||
            $estadoCielo == "63n" ||
            $estadoCielo == "63"
        ) {
            $icono = "tormenta";
        }
        /*  nieve 
        33 ,33n,34,34n,35,35n,36,36n,71,71n,72n,73 */
        if (
            $estadoCielo == "33" ||
            $estadoCielo == "33n" ||
            $estadoCielo == "34" ||
            $estadoCielo == "34n" ||
            $estadoCielo == "35" ||
            $estadoCielo == "35n" ||
            $estadoCielo == "36" ||
            $estadoCielo == "36n" ||
            $estadoCielo == "71" ||
            $estadoCielo == "71n" ||
            $estadoCielo == "72n" ||
            $estadoCielo == "73n" ||
            $estadoCielo == "73"
        ) {
            $icono = "nieve";
        }

        return $icono;
    }
}
