<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data transaksi dengan relasi product
        $data_transaction = Transaction::with('product')->get();

        return view('components.dashboard.index', [
            'header' => 'Dashboard',
            'data_transaction' => $data_transaction
        ]);
    }

    public function getTopProducts()
    {
        $topProducts = DB::table('transaction')
            ->join('product', 'transaction.product_id', '=', 'product.id_product')
            ->select('product.product_name', DB::raw('SUM(transaction.quantity) as total_sold'))
            ->groupBy('transaction.product_id', 'product.product_name')
            ->orderByDesc('total_sold')
            ->limit(5) // Ambil 5 produk terlaris
            ->get();

        return response()->json($topProducts);
    }
}
