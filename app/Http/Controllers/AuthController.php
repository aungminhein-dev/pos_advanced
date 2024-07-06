<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->role == "admin") {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('home');
        }
    }

    public function adminDashboard(Request $request)
    {
        $orderCount = Order::count();
        $totalSoldAmount = Order::where('status', 1)->sum('total');
        $yearlySales = $this->yearlyChartData($request->year);
        $dailySales = $this->dailySaleChartData();
        return view('admin.dashboard', compact('orderCount', 'totalSoldAmount','yearlySales','dailySales'));
    }

    private function yearlyChartData($year)
    {
        if(!$year){
            $year = date('Y');
        }
        $months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        $monthsOfSale = Order::where('status', 1)
        ->whereYear('created_at',$year)
            ->select('created_at', 'total')
            ->get();
        $chartData = [];

        foreach ($months as $month) {
            $chartData[$month] = 0;
        }

        // Fill the chart data array with actual sales data
        foreach ($monthsOfSale as $sale) {
            $month = $sale->created_at->format('M');
            $total = $sale->total;
            $chartData[$month] += $total;
        }

        // Convert chartData array to the required format
        $chartDataFormatted = [];
        foreach ($chartData as $month => $total) {
            $chartDataFormatted[] = [
                "month" => $month,
                "total" => $total
            ];
        }

        return $chartDataFormatted;
    }

    private function dailySaleChartData()
    {
        $dailySales = Order::where('status',1)->orderBy('created_at')->select('total','created_at')->take(7)->get();
        $formattedData = [];
        foreach($dailySales as $sale){
            $date = $sale->created_at->format('d-M (l)');
            $formattedData[$date] = $sale->total;
        }
        return $formattedData;
    }
}
