<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\TennisRacketModel;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class ListTennisRacketModelsController extends Controller
{
    #[OA\Get(
        path: '/api/v1/racket_models',
        summary: 'List of Tennis Racket Models',
        tags: ['TennisRacketModel'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Success',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'id', type: 'integer'),
                            new OA\Property(property: 'name', type: 'string'),
                            new OA\Property(
                                property: 'brand',
                                properties: [
                                    new OA\Property(property: 'id', type: 'integer'),
                                    new OA\Property(property: 'name', type: 'string'),
                                    new OA\Property(property: 'logoUrl', type: 'string'),
                                    new OA\Property(property: 'countryCode', type: 'string'),
                                ],
                                type: 'object'
                            ),
                            new OA\Property(
                                property: 'variants',
                                type: 'array',
                                items: new OA\Items(
                                    properties: [
                                        new OA\Property(property: 'id', type: 'integer'),
                                        new OA\Property(property: 'articleNumber', type: 'string'),
                                        new OA\Property(property: 'color', type: 'string'),
                                        new OA\Property(property: 'weight', type: 'integer'),
                                        new OA\Property(property: 'headSize', type: 'integer'),
                                        new OA\Property(property: 'balance', type: 'integer'),
                                        new OA\Property(property: 'stringPattern', type: 'string'),
                                        new OA\Property(property: 'stiffness', type: 'integer'),
                                        new OA\Property(property: 'length', type: 'integer'),
                                        new OA\Property(property: 'frameProfile', type: 'string'),
                                        new OA\Property(property: 'year', type: 'integer'),
                                    ],
                                    type: 'object'
                                )
                            )
                        ],
                        type: 'object'
                    )
                )
            )
        ]
    )]
    public function __invoke(): JsonResponse
    {
        $models = TennisRacketModel::with(['brand', 'variants'])->get();

        $result = $models->map(fn($model) => [
            'id' => $model->id,
            'name' => $model->name,
            'brand' => [
                'id' => $model->brand->id,
                'name' => $model->brand->name,
                'logoUrl' => $model->brand->logo_url,
                'countryCode' => $model->brand->country_code,
            ],
            'variants' => $model->variants->map(fn($v) => [
                'id' => $v->id,
                'articleNumber' => $v->article_number,
                'color' => $v->color,
                'weight' => $v->weight,
                'headSize' => $v->head_size,
                'balance' => $v->balance,
                'stringPattern' => $v->string_pattern,
                'stiffness' => $v->stiffness,
                'length' => $v->length,
                'frameProfile' => $v->frame_profile,
                'year' => $v->year,
            ]),
        ]);

        return response()->json($result);
    }
}
