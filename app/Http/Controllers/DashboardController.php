<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\ProductPriceHistory;
use App\Models\StockLog;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Range tahun 2025 - 2070
        $years = range(2025, 2070);

        // Pilihan filter
        $selectedYear  = (int) $request->get('year', Carbon::now()->year);
        $selectedMonth = $request->get('month') !== null && $request->get('month') !== '' ? (int)$request->get('month') : null;
        $selectedWeek  = $request->get('week') !== null && $request->get('week') !== '' ? (int)$request->get('week') : null;

        // Summary counts
        $categories = Category::count();
        $suppliers  = Supplier::count();
        $products   = Product::count();
        $purchases  = Purchase::count();
        $sales      = Sale::count();
        $histories  = ProductPriceHistory::count();
        $stocklogs  = StockLog::count();

        $weeks = [];
        $stats = collect();
        $labels = [];
        $transaksi = [];
        $omzet = [];
        $chartTitle = '';

        // CASE 1: Rekap per bulan
        if (!$selectedMonth) {
            $monthData = Sale::selectRaw('MONTH(created_at) as month, COUNT(*) as total_transaksi, COALESCE(SUM(total_amount),0) as total_omzet')
                ->whereYear('created_at', $selectedYear)
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->keyBy('month');

            for ($m = 1; $m <= 12; $m++) {
                $rec = $monthData->get($m);
                $stats->push((object)[
                    'label' => Carbon::createFromDate($selectedYear, $m, 1)->translatedFormat('F'),
                    'total_transaksi' => $rec ? (int)$rec->total_transaksi : 0,
                    'total_omzet'     => $rec ? (float)$rec->total_omzet : 0,
                    'month'           => $m
                ]);
            }

            $chartTitle = "Statistik Penjualan Tahun $selectedYear";

        // CASE 2: Rekap per minggu di bulan tertentu
        } elseif ($selectedMonth && !$selectedWeek) {
            $firstDay = Carbon::createFromDate($selectedYear, $selectedMonth, 1);
            $lastDay = $firstDay->copy()->endOfMonth();
            $daysInMonth = $lastDay->day;
            $weeksCount = (int) ceil($daysInMonth / 7);

            for ($i = 1; $i <= $weeksCount; $i++) {
                $startDay = ($i - 1) * 7 + 1;
                if ($startDay > $daysInMonth) break;
                $endDay = min($i * 7, $daysInMonth);
                $startDate = Carbon::createFromDate($selectedYear, $selectedMonth, $startDay);
                $endDate = Carbon::createFromDate($selectedYear, $selectedMonth, $endDay);

                $row = Sale::whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
                    ->selectRaw('COUNT(*) as total_transaksi, COALESCE(SUM(total_amount),0) as total_omzet')
                    ->first();

                $weeks[] = [
                    'index' => $i,
                    'label' => "Minggu $i (" . $startDate->format('d M') . " - " . $endDate->format('d M') . ")"
                ];

                $stats->push((object)[
                    'label' => "Minggu $i (" . $startDate->format('d M') . " - " . $endDate->format('d M') . ")",
                    'total_transaksi' => $row->total_transaksi ?? 0,
                    'total_omzet'     => $row->total_omzet ?? 0,
                    'week' => $i
                ]);
            }

            $chartTitle = "Statistik Penjualan Bulan " . $firstDay->translatedFormat('F') . " $selectedYear";

        // CASE 3: Rekap per hari dalam minggu tertentu
        } else {
            $firstDay = Carbon::createFromDate($selectedYear, $selectedMonth, 1);
            $lastDay = $firstDay->copy()->endOfMonth();
            $daysInMonth = $lastDay->day;
            $weeksCount = (int) ceil($daysInMonth / 7);

            $weekIndex = max(1, min($selectedWeek, $weeksCount));
            $startDay = ($weekIndex - 1) * 7 + 1;
            $endDay = min($weekIndex * 7, $daysInMonth);
            $startDate = Carbon::createFromDate($selectedYear, $selectedMonth, $startDay);
            $endDate = Carbon::createFromDate($selectedYear, $selectedMonth, $endDay);

            $cursor = $startDate->copy();
            while ($cursor->lte($endDate)) {
                $row = Sale::whereDate('created_at', $cursor->toDateString())
                    ->selectRaw('COUNT(*) as total_transaksi, COALESCE(SUM(total_amount),0) as total_omzet')
                    ->first();

                $stats->push((object)[
                    'label' => $cursor->format('d M Y'),
                    'total_transaksi' => $row->total_transaksi ?? 0,
                    'total_omzet'     => $row->total_omzet ?? 0
                ]);

                $cursor->addDay();
            }

            $chartTitle = "Statistik Penjualan Minggu $weekIndex (" . $startDate->format('d M') . " - " . $endDate->format('d M') . ") $selectedYear";

            for ($i = 1; $i <= $weeksCount; $i++) {
                $s = ($i - 1) * 7 + 1;
                if ($s > $daysInMonth) break;
                $e = min($i * 7, $daysInMonth);
                $sDate = Carbon::createFromDate($selectedYear, $selectedMonth, $s);
                $eDate = Carbon::createFromDate($selectedYear, $selectedMonth, $e);
                $weeks[] = [
                    'index' => $i,
                    'label' => "Minggu $i (" . $sDate->format('d M') . " - " . $eDate->format('d M') . ")"
                ];
            }
        }

        $labels = $stats->pluck('label');
        $transaksi = $stats->pluck('total_transaksi');
        $omzet = $stats->pluck('total_omzet');

        return view('penjualan.dashboard', compact(
            'years', 'selectedYear', 'selectedMonth', 'selectedWeek',
            'weeks', 'stats', 'labels', 'transaksi', 'omzet', 'chartTitle',
            'categories', 'suppliers', 'products', 'purchases', 'sales', 'histories', 'stocklogs'
        ));
    }
}
