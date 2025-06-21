<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class ListBrandsController extends Controller
{
    #[OA\Get(
        path: '/api/v1/brands',
        summary: 'Get list of brands',
        tags: ['Brand'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of Brands',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'id', type: 'integer'),
                            new OA\Property(property: 'name', type: 'string'),
                            new OA\Property(property: 'logoUrl', type: 'string'),
                            new OA\Property(property: 'countryCode', type: 'string'),
                        ],
                        type: 'object'
                    )
                )
            )
        ]
    )]
    public function __invoke(): JsonResponse
    {
        $brands = Brand::all()->map(fn($brand) => [
            'id' => $brand->id,
            'name' => $brand->name,
            'logoUrl' => $brand->logo_url,
            'countryCode' => $brand->country_code,
        ]);

        return response()->json($brands);
    }
}
