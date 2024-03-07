<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use App\Models\Subtotal;

class AnalysisApiController extends Controller
{

    public function index(Request $request)
    {
        return response()->json([
            'data' => $request->startDate
        ], Response::HTTP_OK);
    } 
}
