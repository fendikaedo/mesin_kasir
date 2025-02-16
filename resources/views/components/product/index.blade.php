<x-layouts.app>
    <x-slot:header>{{ $header }}</x-slot:header>
    <div class="btn__create">
        <a href="{{ route('product.create') }}">Tambah</a>
    </div>
    <div class="table__container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga Produk</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Total Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_product as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->product_code }}</td>
                    <td>{{ $data->product_name }}</td>
                    <td>Rp.{{ number_format($data->product_price, 0, ',', '.') }}</td>
                    <td>{{ $data->stock }}</td>
                    <td>{{ $data->category->category_name }}</td>
                    <td>Rp.{{ number_format($data->total_price, 0, ',', '.') }}</td>
                    <td class="action">
                        <a href="{{ route('product.show',$data->id_product) }}" class="show">
                            Show Barcode
                        </a>
                        <a href="{{ route('product.edit',$data->id_product) }}" class="edit">
                            Edit
                        </a>
                        <a href="#" class="delete" data-id="{{ $data->id_product }}" data-route="{{ route('product.destroy', $data->id_product) }}">
                            Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>
