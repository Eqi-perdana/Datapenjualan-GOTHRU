<?php

namespace App\Http\Controllers;

// Import model Sale
use App\Models\Sale;

// Import return type View
use Illuminate\View\View;

class SaleController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        // get all sales
        $sales = Sale::latest()->paginate(10);

        // render view with sales
        return view('sales.index', compact('sales'));
    }
}

