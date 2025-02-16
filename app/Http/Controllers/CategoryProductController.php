<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_category = CategoryProduct::all();
        return view('components.category.index', ['header' => 'Category Product'], compact('data_category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.category.create', ['header' => 'Category Product / Create']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->ajax());
        $request->validate([
            'category_name' => 'required|string|max:255'
        ]);

        $category = CategoryProduct::create([
            'category_name' => $request->category_name
        ]);

        if ($category) {
            return response()->json([
                'success' => 'Kategori berhasil ditambahkan!',
                'redirect' => route('category_product.index')
            ], 200);
        } else {
            return response()->json([
                'error' => 'Gagal menambahkan kategori'
            ], 500);
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
    public function edit(string $id_category)
    {
        $categoryProductId = CategoryProduct::findOrFail($id_category);

        return view('components.category.edit', ['header' => 'Category Product / Edit'], compact('categoryProductId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_category)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        try {
            $category = CategoryProduct::findOrFail($id_category);
            $category->update([
                'category_name' => $request->category_name,
            ]);

            return response()->json([
                'success' => 'Data berhasil diperbarui',
                'redirect' => route('category_product.index')
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
    public function destroy(string $id_category)
    {
        $category = CategoryProduct::find($id_category);
        if (!$category) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $category->delete();
        return response()->json(['success' => 'Kategori berhasil dihapus']);;
    }
}
