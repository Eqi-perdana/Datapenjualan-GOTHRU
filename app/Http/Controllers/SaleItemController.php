<?php

namespace App\Http\Controllers;

// Import model SaleItem
use App\Models\SaleItem;

// Import return type View
use Illuminate\View\View;

class SaleItemController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        // get all sale items
        $saleItems = SaleItem::latest()->paginate(10);

        // render view with sale items
        return view('sale_items.index', compact('saleItems'));
    }
}
