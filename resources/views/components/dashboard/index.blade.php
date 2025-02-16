<x-layouts.app>
    <x-slot:header>{{ $header }}</x-slot:header>
    <h1 class="info__chart">Produk Terlaris</h1>
    <canvas id="topProductsChart"></canvas>

    <h1 class="info__table">Detail Transaksi</h1>
    <div class="table__container">
        <table>
            <thead>
                <tr class="info__table">
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Total Pembelian</th>
                    <th>Jumlah Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_transaction as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->product->product_name }}</td>
                    <td>{{ $data->quantity }}</td>
                    <td>Rp.{{ $data->total_price }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>
