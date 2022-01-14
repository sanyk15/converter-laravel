<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Services\ConverterService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $currencies = Currency::query()->orderBy('slug')->get();

        if ($request->collect(['from', 'to', 'amount'])) {
            $result = app()->make(ConverterService::class)->convert($request->get('from'), $request->get('to'), $request->get('amount'));
        }

        return view('index', compact('currencies', 'result'));
    }
}
