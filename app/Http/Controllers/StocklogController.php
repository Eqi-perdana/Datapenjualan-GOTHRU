<?php

namespace App\Http\Controllers;

// Import model StockLog
use App\Models\StockLog;

// Import return type View
use Illuminate\View\View;

class StockLogController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        // get all stock logs
        $stockLogs = StockLog::latest()->paginate(10);

        // render view with stock logs
        return view('stock_logs.index', compact('stockLogs'));
    }
}
