let cart = [];

function addItem() {
    let itemName = document.getElementById("item").value;
    let itemPrice = parseFloat(document.getElementById("price").value);
    let itemQty = parseInt(document.getElementById("quantity").value);

    if (itemName === "" || isNaN(itemPrice) || isNaN(itemQty) || itemPrice <= 0 || itemQty <= 0) {
        alert("Harap isi semua field dengan benar!");
        return;
    }

    let total = itemPrice * itemQty;
    cart.push({ name: itemName, price: itemPrice, qty: itemQty, total: total });

    updateCart();
    clearInput();
}

function updateCart() {
    let cartTable = document.getElementById("cart-items");
    cartTable.innerHTML = "";
    let totalPrice = 0;

    cart.forEach((item, index) => {
        totalPrice += item.total;
        cartTable.innerHTML += `
            <tr>
                <td>${item.name}</td>
                <td>Rp ${item.price}</td>
                <td>${item.qty}</td>
                <td>Rp ${item.total}</td>
                <td><button onclick="removeItem(${index})">Hapus</button></td>
            </tr>
        `;
    });

    document.getElementById("total-price").innerText = totalPrice;
}

function removeItem(index) {
    cart.splice(index, 1);
    updateCart();
}

function clearInput() {
    document.getElementById("item").value = "";
    document.getElementById("price").value = "";
    document.getElementById("quantity").value = "1";
}

function processPayment() {
    if (cart.length === 0) {
        alert("Keranjang kosong!");
        return;
    }

    let data = { items: cart, total: document.getElementById("total-price").innerText };

    fetch("https://jsonplaceholder.typicode.com/posts", {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(response => response.json())
    .then(data => {
        alert("Pembayaran berhasil! Transaksi tersimpan.");
        cart = [];
        updateCart();
    })
    .catch(error => console.error("Error:", error));
}
