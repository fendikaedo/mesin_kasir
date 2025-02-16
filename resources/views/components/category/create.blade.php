<x-layouts.app>
    <x-slot:header>{{ $header }}</x-slot:header>
    <div class="btn__back">
        <a href="{{ route('category_product.index') }}">Kembali</a>
    </div>
    <div class="form-container">
        <h2>Form Category Product</h2>
        <form action="{{ route('category_product.store') }}" method="POST" class="formCreate">
            @csrf
            <div class="form__item">
                <input type="text" name="category_name" required>
                <label>Nama Kategori Produk</label>
            </div>
            <button type="submit">Simpan</button>
        </form>
    </div>
</x-layouts.app>
