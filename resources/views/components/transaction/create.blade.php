<x-layouts.app>
    <x-slot:header>Transaksi Produk</x-slot:header>

    <div class="form-container">
        <h2>Transaksi Produk</h2>
        <form id="transactionForm">
            @csrf
            <div class="form__item">
                <select id="product_id" name="product_id" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($data_product as $product)
                        <option value="{{ $product->id_product }}" data-stock="{{ $product->stock }}"
                            data-price="{{ $product->product_price }}">
                            {{ $product->product_name }} (Stok: {{ $product->stock }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form__item">
                <input type="number" id="quantity" name="quantity" required>
                <label for="quantity">Jumlah</label>
            </div>
            <button type="button" id="calculateTotal">Beli</button>
        </form>

        <div id="totalBayar">
            Total Bayar: Rp <span id="totalBayarValue">0</span>
        </div>

        <form id="paymentForm" style="display: none;">
            <div class="form__item">
                <input type="number" id="amountPaid" name="amount_paid" required>
                <label for="amountPaid">Total Bayar dari Pelanggan</label>
            </div>
            <button type="submit">Bayar</button>
        </form>

        <div id="responseMessage" class="response-message"></div>
    </div>



    <script>
        document.getElementById("calculateTotal").addEventListener("click", function() {
            let productId = document.getElementById("product_id").value;
            let quantity = parseInt(document.getElementById("quantity").value);
            let selectedOption = document.querySelector("#product_id option:checked");
            let productPrice = parseFloat(selectedOption.dataset.price);
            let stockAvailable = parseInt(selectedOption.dataset.stock);

            if (!productId || !quantity || quantity <= 0) {
                alert("Harap pilih produk dan masukkan jumlah yang valid!");
                return;
            }

            if (quantity > stockAvailable) {
                alert(`Stok tidak mencukupi! Stok tersisa: ${stockAvailable}`);
                document.getElementById("totalBayarValue").textContent = "";
                document.getElementById("totalBayar").style.display = "none";
                document.getElementById("paymentForm").style.display = "none";
                return;
            }

            let totalBayar = productPrice * quantity;

            document.getElementById("totalBayarValue").textContent = totalBayar.toLocaleString();
            document.getElementById("totalBayar").style.display = "block";
            document.getElementById("paymentForm").style.display = "block";
        });

        document.getElementById("paymentForm").addEventListener("submit", function(e) {
            e.preventDefault();

            let productId = document.getElementById("product_id").value;
            let quantity = parseInt(document.getElementById("quantity").value);
            let totalBayar = parseFloat(document.getElementById("totalBayarValue").textContent.replace(/\./g, ""));
            let amountPaid = parseFloat(document.getElementById("amountPaid").value);
            let selectedOption = document.querySelector("#product_id option:checked");
            let stockAvailable = parseInt(selectedOption.dataset.stock);

            if (!amountPaid || amountPaid < totalBayar) {
                alert("Jumlah pembayaran tidak mencukupi!");
                return;
            }

            let formData = {
                product_id: productId,
                quantity: quantity,
                total_price: totalBayar,
                amount_paid: amountPaid,
                _token: document.querySelector('input[name="_token"]').value,
            };

            fetch('/transaction', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(`Stok tidak mencukupi! Stok tersisa: ${data.stock_remaining}`);

                        document.getElementById("totalBayarValue").textContent = "";
                        document.getElementById("totalBayar").style.display = "none";
                        document.getElementById("paymentForm").style.display = "none";

                        return;
                    }

                    alert("Transaksi berhasil!");
                    document.getElementById("totalBayarValue").textContent =
                        `Rp ${data.data.total_price.toLocaleString()}`;

                    let newStock = stockAvailable - quantity;
                    selectedOption.dataset.stock = newStock;
                    selectedOption.textContent =
                        `${selectedOption.textContent.split(" - ")[0]} - Stok: ${newStock}`;

                    if (newStock <= 0) {
                        selectedOption.disabled = true;
                    }

                    document.getElementById("transactionForm").reset();
                    document.getElementById("paymentForm").reset();
                    document.getElementById("totalBayar").style.display = "none";
                    document.getElementById("paymentForm").style.display = "none";
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</x-layouts.app>
