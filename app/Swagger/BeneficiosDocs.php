<?php
namespace App\Swagger;

/**
 * @OA\Get(
 *     path="/api/beneficios",
 *     summary="Obtiene la lista de beneficios agrupados por año",
 *     @OA\Response(
 *         response=200,
 *         description="Respuesta exitosa con beneficios",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="code", type="integer", example=200),
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="year", type="integer", example=2023),
 *                     @OA\Property(property="num", type="integer", example=1),
 *                     @OA\Property(
 *                         property="beneficios",
 *                         type="array",
 *                         @OA\Items(
 *                             type="object",
 *                             @OA\Property(property="id_programa", type="integer", example=147),
 *                             @OA\Property(property="monto", type="integer", example=40656),
 *                             @OA\Property(property="fecha_recepcion", type="string", example="09/11/2023"),
 *                             @OA\Property(property="fecha", type="string", example="2023-11-09"),
 *                             @OA\Property(property="anio", type="string", example="2023"),
 *                             @OA\Property(property="view", type="boolean", example=true),
 *                             @OA\Property(
 *                                 property="ficha",
 *                                 type="object",
 *                                 @OA\Property(property="id", type="integer", example=922),
 *                                 @OA\Property(property="nombre", type="string", example="Emprende"),
 *                                 @OA\Property(property="id_programa", type="integer", example=147),
 *                                 @OA\Property(property="url", type="string", example="emprende"),
 *                                 @OA\Property(property="categoria", type="string", example="trabajo"),
 *                                 @OA\Property(property="descripcion", type="string", example="Fondos concursables para nuevos negocios")
 *                             )
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     )
 * )
 */
class BeneficiosDocs
{
    // Esta clase puede quedar vacía,
    // solo existe para contener las anotaciones Swagger/OpenAPI.
}