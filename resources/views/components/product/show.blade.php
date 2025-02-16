<x-layouts.app>
    <x-slot:header>Produk / Detail Produk</x-slot:header>
    <div class="btn__back">
        <a href="{{ route('product.index') }}">Kembali</a>
    </div>

    <div class="barcode__container">
        <img src="{{ $barcodePath }}" alt="">
    </div>
</x-layouts.app>
