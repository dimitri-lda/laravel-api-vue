<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Info(version: "1.0", title: "example API")]
class ApiExampleController extends Controller
{
    #[OA\Get(
        path: '/api/example',
        summary: 'example API endpoint in Laravel (swagger autoupdates)',
        tags: ['Test section'],
        responses: [
            new OA\Response(response: 200, description: "Successful response")
        ]
    )]
    public function index(Request $request)
    {
        $message = 'Hello! It is response by Laravel API.';
        $id = $request->input('text');

        if ($id !== null) {
            $message .= ' You have entered: ' . $request->input('text');
        } else {
            $message .= ' You haven\'t entered anything.';
        }

        return response()->json([
            'message' => $message,
            'datetime' => (new DateTime())->format('Y-m-d H:i:s'),
        ]);
    }
}
