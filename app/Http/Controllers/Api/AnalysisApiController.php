<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use App\Models\Subtotal;
use App\Services\AnalysisService;

class AnalysisApiController extends Controller
{

    public function index(Request $request)
    {
        $subQuery = Subtotal::betweenDate($request->startDate, $request->endDate);
        
        if ($request->type === 'perDay') {
            list($data, $labels, $totals) = AnalysisService::perDay($subQuery);
        }

        return response()->json([
            'data' => $data,
            'labels' => $labels,
            'totals' => $totals,
            'type' => $request->type
        ], Response::HTTP_OK);
    } 
}
