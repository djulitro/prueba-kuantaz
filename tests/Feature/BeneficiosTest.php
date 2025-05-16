<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class BeneficiosTest extends TestCase
{
    public function test_get_beneficios_filtrados()
    {
        Http::fake([
            env('KUANTAZ_API_URL') . '8f75c4b5-ad90-49bb-bc52-f1fc0b4aad02' => Http::response([
                'data' => [
                    ['id_programa' => 1, 'monto' => 1000, 'fecha' => '2023-01-01'],
                    ['id_programa' => 1, 'monto' => 500, 'fecha' => '2023-01-02'],
                    ['id_programa' => 2, 'monto' => 2000, 'fecha' => '2022-01-03'],
                    ['id_programa' => 2, 'monto' => 1500, 'fecha' => '2022-01-04'],
                ]
            ], 200),
            env('KUANTAZ_API_URL') . 'b0ddc735-cfc9-410e-9365-137e04e33fcf' => Http::response([
                'data' => [
                    ['id_programa' => 1, 'tramite' => "prueba", "min" => 0, "max" => 1000, "ficha" => 1],
                    ['id_programa' => 2, 'tramite' => "prueba", "min" => 1000, "max" => 2000, "ficha" => 2],
                ]
            ], 200),
            env('KUANTAZ_API_URL') . '4654cafa-58d8-4846-9256-79841b29a687' => Http::response([
                'data' => [
                    ['id' => 1, 'nombre' => 'fake', 'id_programa' => 1, 'url' => 'fake', 'categoria' => 'fake', 'descripcion' => 'Esto es una ficha Fake'],
                    ['id' => 2, 'nombre' => 'fake', 'id_programa' => 2, 'url' => 'fake', 'categoria' => 'fake', 'descripcion' => 'Esto es una ficha Fake'],
                ]
            ], 200)
        ]);

        $response = $this->get('/api/beneficios');
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'success',
                'data' => [
                    '*' => [
                        'year',
                        'num',
                        'beneficios' => [
                            '*' => [
                                'id_programa',
                                'monto',
                                'fecha',
                                'view',
                                'ficha' => [
                                    'id',
                                    'nombre',
                                    'id_programa',
                                    'url',
                                    'categoria',
                                    'descripcion'
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
    }
}
