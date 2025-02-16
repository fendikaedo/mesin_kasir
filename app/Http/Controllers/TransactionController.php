<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data_product = Product::all();
        // return view('components.transaction.index',['header' => 'Transaction'],compact('data_product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_product = Product::all();
        return view('components.transaction.create', ['header' => 'Transaction'], compact('data_product'));
    }

    public function store(Request $request)
{
    try {
        DB::beginTransaction();

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id_product',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:1',
            'amount_paid' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Simpan transaksi
        $product = Product::findOrFail($request->product_id);
        if ($product->stock < $request->quantity) {
            return response()->json(['error' => 'Stok tidak mencukupi!', 'stock_remaining' => $product->stock], 400);
        }

        $product->decrement('stock', $request->quantity);
        $transaction = Transaction::create($request->only('product_id', 'quantity', 'total_price'));

        DB::commit();

        return response()->json([
            'message' => 'Transaksi berhasil!',
            'data' => [
                'id' => $transaction->id,
                'product_id' => $transaction->product_id,
                'quantity' => $transaction->quantity,
                'total_price' => $transaction->total_price,
                'created_at' => $transaction->created_at,
            ]
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
