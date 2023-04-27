<?php

use App\Models\Ciudad;

if (!function_exists('separar_carnet')) {
    function separar_carnet(string $texto)
    {
        $carnet = null;
        $complemento = null;
        $ciudad = null;

        $partes = preg_split('/[\ -]/', $texto);
        $partes = array_map('trim', array_filter($partes));
        if (count($partes) == 1) {
            $carnet = $partes[0];
        } elseif (count($partes) == 2) {
            $carnet = $partes[0];
            $ciudad = Ciudad::where('nombre', 'like', "%{$partes[1]}%")->orWhere('codigo', 'like', "%{$partes[1]}%")->first();
            if (!$ciudad) {
                $complemento = $partes[1];
            }
        } else {
            $carnet = $partes[0];
            $complemento = $partes[1];
            $ciudad = Ciudad::where('nombre', 'like', "%{$partes[2]}%")->orWhere('codigo', 'like', "%{$partes[2]}%")->first();
        }

        return [$carnet, $complemento, $ciudad];
    }
}
