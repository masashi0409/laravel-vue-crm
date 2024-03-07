<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\Subtotal;

class AnalysisController extends Controller
{

    public function index()
    {
        return Inertia::render('Analysis');
    } 
}
