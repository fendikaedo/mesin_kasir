<x-layouts.app>
    <x-slot:header>{{ $header }}</x-slot:header>
    <div class="btn__back">
        <a href="{{ route('product.index') }}">Kembali</a>
    </div>
    <div class="form-container">
        <h2>Edit Product</h2>
        <form class="formEdit" action="{{ route('product.update', $productId->id_product) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form__item">
                <input type="text" id="product_code" name="product_code" value="{{ $productId->product_code }}"
                    required>
                <label for="product_code">Kode Produk</label>
            </div>
            <div class="form__item">
                <input type="text" id="product_name" name="product_name" value="{{ $productId->product_name }}"
                    required>
                <label for="product_name">Nama Produk</label>
            </div>
            <div class="form__item">
                <input type="number" id="product_price" name="product_price"
                    value="{{ $productId->product_price }}" required>
                <label for="product_price">Harga Produk</label>
            </div>
            <div class="form__item">
                <input type="number" id="stock" name="stock" value="{{ $productId->stock }}" required>
                <label for="stock">Stok</label>
            </div>
            <div class="form__item">
                <select id="category_product_id" name="category_product_id" required>
                    <option value="">-- Pilih Kategori Produk --</option>
                    @foreach ($data_category as $category)
                        <option value="{{ $category->id_category }}"
                            {{ old('category_product_id', $productId->category_product_id) == $category->id_category ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Simpan</button>
        </form>
    </div>
</x-layouts.app>
