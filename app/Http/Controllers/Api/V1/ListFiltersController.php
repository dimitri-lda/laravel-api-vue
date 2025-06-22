<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\TennisRacketVariant;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use OpenApi\Attributes as OA;

class ListFiltersController extends Controller
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
    public function brands(): JsonResponse
    {
        $brands = Brand::all()->map(fn($brand) => [
            'id' => $brand->id,
            'name' => $brand->name,
            'logoUrl' => $brand->logo_url,
            'countryCode' => $brand->country_code,
        ]);

        return response()->json($brands);
    }

    #[OA\Get(
        path: '/api/v1/filters/head-sizes',
        summary: 'Get list of available head sizes',
        tags: ['Filters'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of available head sizes',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'value', type: 'integer', example: 98),
                            new OA\Property(property: 'label', type: 'string', example: '98 sq in'),
                        ],
                        type: 'object'
                    )
                )
            )
        ]
    )]
    public function headSizes(): JsonResponse
    {
        $headSizes = TennisRacketVariant::query()
            ->whereNotNull('head_size')
            ->distinct()
            ->orderBy('head_size')
            ->pluck('head_size')
            ->map(fn($size) => [
                'value' => $size,
                'label' => $size . ' in² / ' .  TennisRacketVariant::getSquareCentimetersBySquareInches($size) . ' cm²',
                ]);

        return response()->json($headSizes);
    }

    #[OA\Get(
        path: '/api/v1/filters/balances',
        summary: 'Get list of available balance values',
        tags: ['Filters'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of available balance values',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'value', type: 'integer'),
                            new OA\Property(property: 'label', type: 'string'),
                        ],
                        type: 'object'
                    )
                )
            )
        ]
    )]
    public function balances(): JsonResponse
    {
        $balances = TennisRacketVariant::query()
            ->whereNotNull('balance')
            ->distinct()
            ->orderBy('balance')
            ->pluck('balance')
            ->map(fn($bal) => [
                'value' => $bal,
                'label' => $bal . ' mm',
            ]);

        return response()->json($balances);
    }

    #[OA\Get(
        path: '/api/v1/filters/weights',
        summary: 'Get list of available weights',
        tags: ['Filters'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of available weights',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'value', type: 'integer'),
                            new OA\Property(property: 'label', type: 'string'),
                        ],
                        type: 'object'
                    )
                )
            )
        ]
    )]
    public function weights(): JsonResponse
    {
        $weights = TennisRacketVariant::query()
            ->whereNotNull('weight')
            ->distinct()
            ->orderBy('weight')
            ->pluck('weight')
            ->map(fn($w) => [
                'value' => $w,
                'label' => $w . ' g',
            ]);

        return response()->json($weights);
    }

    #[OA\Get(
        path: '/api/v1/filters/string-patterns',
        summary: 'Get list of available string patterns',
        tags: ['Filters'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of available string patterns',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'value', type: 'string'),
                            new OA\Property(property: 'label', type: 'string'),
                        ],
                        type: 'object'
                    )
                )
            )
        ]
    )]
    public function stringPatterns(): JsonResponse
    {
        $patterns = TennisRacketVariant::query()
            ->whereNotNull('string_pattern')
            ->distinct()
            ->orderBy('string_pattern')
            ->pluck('string_pattern')
            ->map(fn($p) => [
                'value' => $p,
                'label' => $p,
            ]);

        return response()->json($patterns);
    }

    #[OA\Get(
        path: '/api/v1/filters/frame-profiles',
        summary: 'Get list of available frame profiles',
        tags: ['Filters'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of available frame profiles',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'value', type: 'string'),
                            new OA\Property(property: 'label', type: 'string'),
                        ],
                        type: 'object'
                    )
                )
            )
        ]
    )]
    public function frameProfiles(): JsonResponse
    {
        $profiles = TennisRacketVariant::query()
            ->whereNotNull('frame_profile')
            ->distinct()
            ->orderBy('frame_profile')
            ->pluck('frame_profile')
            ->map(fn($f) => [
                'value' => $f,
                'label' => $f,
            ]);

        return response()->json($profiles);
    }

    #[OA\Get(
        path: '/api/v1/filters/years',
        summary: 'Get list of available production years',
        tags: ['Filters'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of available years',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'value', type: 'integer'),
                            new OA\Property(property: 'label', type: 'string'),
                        ],
                        type: 'object'
                    )
                )
            )
        ]
    )]
    public function years(): JsonResponse
    {
        $years = TennisRacketVariant::query()
            ->whereNotNull('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->map(fn($y) => [
                'value' => $y,
                'label' => (string)$y,
            ]);

        return response()->json($years);
    }
}
