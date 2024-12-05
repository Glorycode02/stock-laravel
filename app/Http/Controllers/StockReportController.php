<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Product_in;
use App\Models\Product_out;
use App\Models\Shopkeepers;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StockReportController extends Controller
{
    public function index(Request $request)
    {
        if (!session()->exists("loginId")) {
            return redirect('login')->with('fail', 'Login first to access this page!');
        }

        $title = 'Stock-Report';
        $reportType = $request->input('report_type', 'daily');
        $shopkeeper = Shopkeepers::where("ShopkeeperId", session()->get("loginId"))->first();

        // Determine the date range based on the report type
        $startDate = null;
        $endDate = Carbon::now();

        switch ($reportType) {
            case 'daily':
                $startDate = Carbon::today();
                break;

            case 'weekly':
                $startDate = Carbon::now()->subWeek();
                break;

            case 'monthly':
                $startDate = Carbon::now()->subMonth();
                break;
        }

        // Fetch all products
        $products = Products::all();

        // Initialize an array to store stock data
        $stockData = [];

        // Loop through each product to calculate stock status
        foreach ($products as $product) {
            // Total stock-in for this product within the date range
            $totalIn = Product_in::where('ProductCode', $product->ProductCode)
                ->whereBetween('DateTime', [$startDate, $endDate])
                ->sum('Quantity');

            // Total stock-out for this product within the date range
            $totalOut = Product_out::where('ProductCode', $product->ProductCode)
                ->whereBetween('DateTime', [$startDate, $endDate])
                ->sum('Quantity');

            // Available stock = totalIn - totalOut
            $availableStock = $totalIn - $totalOut;

            // Calculate total price of stock-in and stock-out
            $totalPriceIn = Product_in::where('ProductCode', $product->ProductCode)
                ->whereBetween('DateTime', [$startDate, $endDate])
                ->sum('TotalPrice');
            $totalPriceOut = Product_out::where('ProductCode', $product->ProductCode)
                ->whereBetween('DateTime', [$startDate, $endDate])
                ->sum('TotalPrice');

            // Add this product's stock data to the array
            $stockData[] = [
                'ProductCode' => $product->ProductCode,
                'ProductName' => $product->ProductName,
                'TotalIn' => $totalIn,
                'TotalOut' => $totalOut,
                'AvailableStock' => $availableStock,
                'TotalPriceIn' => $totalPriceIn,
                'TotalPriceOut' => $totalPriceOut
            ];
        }

        // Pass the stock data and current report type to the view
        return view('stock-report.index', compact('stockData', 'reportType', 'shopkeeper','title'));
    }
}
