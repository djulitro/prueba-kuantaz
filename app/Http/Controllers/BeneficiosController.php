<?php

namespace App\Http\Controllers;

use App\Services\KuantazService;
use Illuminate\Http\Request;

class BeneficiosController extends Controller
{
    public function getBeneficios()
    {
        $kuantazService = new KuantazService();
        $beneficios = $kuantazService->getBeneficios();
        $filtros = $kuantazService->getFiltros();
        $fichas = $kuantazService->getFichas();

        $beneficiosFiltrados = $beneficios->filter(function ($beneficio) use ($filtros) {
            if (!$filtros) return false;

            $filtro = $filtros->firstWhere('id_programa', $beneficio['id_programa']);

            $monto = $beneficio['monto'];

            return $monto >= $filtro['min'] && $monto <= $filtro['max'];
        });

        $agrupadosPorAnio = $beneficiosFiltrados->map(function ($beneficio) use ($fichas) {
            $beneficio['anio'] = date('Y', strtotime($beneficio['fecha']));
            $beneficio['view'] = true;

            $ficha = $fichas->firstWhere('id_programa', $beneficio['id_programa']);
            $beneficio['ficha'] = $ficha;

            return $beneficio;
        });

        $agrupadoPorAnio = $agrupadosPorAnio->groupBy('anio')->sortKeysDesc();

        $respuesta = $agrupadoPorAnio->map(function ($beneficios, $anio) {
            return [
                'year' => $anio,
                'num' => $beneficios->count(),
                'beneficios' => $beneficios->values()
            ];
        })->values();

        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => $respuesta
        ]);
    }
}
