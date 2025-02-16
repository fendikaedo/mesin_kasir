<x-layouts.app>
    <x-slot:header>{{ $header }}</x-slot:header>
    <div class="btn__create">
        <a href="{{ route('category_product.create') }}">Tambah</a>
    </div>
    <div class="table__container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori Produk</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_category as $data)
                <tr>
                    <td>{{ $data->id_category }}</td>
                    <td>{{ $data->category_name }}</td>
                    <td class="action">
                        <a href="{{ route('category_product.edit',$data->id_category) }}" class="edit">
                            Edit
                        </a>
                        <a href="" class="delete" data-id="{{ $data->id_category }}" data-route="{{ route('category_product.destroy', $data->id_category) }}">
                            Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>
