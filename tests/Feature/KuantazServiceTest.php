<?php

namespace Tests\Feature;

use App\Services\KuantazService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class KuantazServiceTest extends TestCase
{
    public function testGetBeneficiosReturnsCollection()
    {
        Http::fake([
            env('KUANTAZ_API_URL') .'8f75c4b5-ad90-49bb-bc52-f1fc0b4aad02' => Http::response([
                'data' => [
                    ['id_programa' => 1, 'monto' => 1000, 'fecha' => '2023-01-01']
                ]
            ], 200)
        ]);

        $kuantasService = new KuantazService();
        $beneficios = $kuantasService->getBeneficios();

        $this->assertIsIterable($beneficios);
        $this->assertEquals(1, $beneficios->first()['id_programa']);
    }

    public function testGetFiltrosReturnsCollection()
    {
        Http::fake([
            env('KUANTAZ_API_URL') .'b0ddc735-cfc9-410e-9365-137e04e33fcf' => Http::response([
                'data' => [
                    ['id_programa' => 1,'tramite' => "prueba", "min" => 0, "max" => 1000, "ficha" => 1]
                ]
            ], 200)
        ]);

        $kuantasService = new KuantazService();
        $filtros = $kuantasService->getFiltros();

        $this->assertIsIterable($filtros);
        $this->assertEquals(1000, $filtros->first()['max']);
    }

    public function testGetFichasReturnsCollection()
    {
        Http::fake([
            env('KUANTAZ_API_URL') .'4654cafa-58d8-4846-9256-79841b29a687' => Http::response([
                'data' => [
                    ['id' => 1, 'nombre' => 'fake', 'id_programa' => 1, 'url' => 'fake', 'categoria' => 'fake', 'descripcion' => 'Esto es una ficha Fake']
                ]
            ], 200)
        ]);

        $kuantasService = new KuantazService();
        $fichas = $kuantasService->getFichas();

        $this->assertIsIterable($fichas);
        $this->assertEquals(1, $fichas->first()['id']);
    }
}
