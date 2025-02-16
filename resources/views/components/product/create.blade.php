<x-layouts.app>
    <x-slot:header>{{ $header }}</x-slot:header>
    <div class="btn__back">
        <a href="{{ route('product.index') }}">Kembali</a>
    </div>
    <div class="form-container">
        <h2>Form Produk</h2>
        <form class="formCreate" action="{{ route('product.store') }}" method="POST">
            @csrf
            <div class="form__item">
                <input type="text" id="product_code" name="product_code" required>
                <label for="product_code">Kode Produk</label>
            </div>
            <div class="form__item">
                <input type="text" id="product_name" name="product_name" required>
                <label for="product_name">Nama Produk</label>
            </div>
            <div class="form__item">
                <input type="number" id="product_price" name="product_price" required>
                <label for="product_price">Harga Produk</label>
            </div>
            <div class="form__item">
                <input type="number" id="stock" name="stock" required>
                <label for="stock">Stok</label>
            </div>
            <div class="form__item">
                <select id="category_product_id" name="category_product_id">
                    <option value="">-- Pilih Kategori Produk --</option>
                    @foreach ($data_category as $category)
                        <option value="{{ $category->id_category }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Simpan</button>
        </form>
    </div>
</x-layouts.app>
