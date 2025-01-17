<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $this->authorize("create", Todo::class);

        return response()->json([
            "message" => "success"
        ]);
    }
}
