<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorHTML;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_product = Product::with('category')->get();
        return view('components.product.index', ['header' => 'Product'], compact('data_product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_category = CategoryProduct::all();
        return view('components.product.create', ['header' => 'Product / Create'], compact('data_category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required',
            'product_name' => 'required',
            'product_price' => 'required',
            'stock' => 'required|integer',
            'category_product_id' => 'required|exists:category_product,id_category',
        ]);

        $product = Product::create([
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'stock' => $request->stock,
            'category_product_id' => $request->category_product_id,
        ]);

        if ($product) {
            return response()->json([
                'success' => 'Produk berhasil ditambahkan!',
                'redirect' => route('product.index')
            ], 200);
        } else {
            return response()->json([
                'error' => 'Gagal menambahkan produk'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    // Make Barcode object of Code128 encoding.
    // $product_code = Product::where('product_code');
    public function show(string $id_product)
    {
        // Ambil data produk berdasarkan ID
        $product = Product::findOrFail($id_product);

        // Ambil product_code
        $productCode = $product->product_code;
        $productName = $product->product_name;

        // Generate barcode PNG
        $generator = new BarcodeGeneratorPNG();
        $barcodeData = $generator->getBarcode($productCode, $generator::TYPE_CODE_128,4,100);

        // Tentukan path file
        $fileName = 'barcode_' . $productCode . '.png';
        $path = public_path('barcodes/' . $fileName);

        // Pastikan folder ada sebelum menyimpan file
        if (!file_exists(public_path('barcodes'))) {
            mkdir(public_path('barcodes'), 0777, true);
        }

        // Simpan file di public/barcodes
        file_put_contents($path, $barcodeData);

        // Kirim path barcode ke view
        $barcodePath = asset('barcodes/' . $fileName);

        return view('components.product.show', compact('barcodePath'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_product)
    {
        $productId = Product::findOrFail($id_product);
        $data_category = CategoryProduct::all();

        return view('components.product.edit', [
            'header' => 'Product / Edit',
            'productId' => $productId,
            'data_category' => $data_category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_product)
    {
        $request->validate([
            'product_code' => 'required',
            'product_name' => 'required',
            'product_price' => 'required',
            'stock' => 'required|integer',
            'category_product_id' => 'required|exists:category_product,id_category',
        ]);

        try {
            $product = Product::findOrFail($id_product);
            $product->update([
                'product_code' => $request->product_code,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'stock' => $request->stock,
                'category_product_id' => $request->category_product_id,
            ]);

            return response()->json([
                'success' => 'Data Produk berhasil diperbarui',
                'redirect' => route('product.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_product)
    {
        $product = Product::find($id_product);
        if (!$product) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $product->delete();
        return response()->json(['success' => 'Product berhasil dihapus']);;
    }
}
