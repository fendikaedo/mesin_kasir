<x-layouts.app>
    <x-slot:header>{{ $header }}</x-slot:header>
    <div class="btn__back">
        <a href="{{ route('category_product.index') }}">Kembali</a>
    </div>
    <div class="form-container">
        <h2>Edit Category Product</h2>
        <form class="formEdit" action="{{ route('category_product.update', $categoryProductId->id_category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form__item">
                <input type="text" name="category_name" value="{{ $categoryProductId->category_name }}" required>
                <label>Nama Kategori Produk</label>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</x-layouts.app>
