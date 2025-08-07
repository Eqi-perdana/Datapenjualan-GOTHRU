<?php

namespace App\Http\Controllers;

// Import model PurchaseItem
use App\Models\PurchaseItem;

// Import return type View
use Illuminate\View\View;

class PurchaseItemController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        // get all purchase items
        $purchaseItems = PurchaseItem::latest()->paginate(10);

        // render view with purchase items
        return view('purchase_items.index', compact('purchaseItems'));
    }
}

