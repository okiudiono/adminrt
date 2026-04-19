<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir - Kuat Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            background-color: #28a745;
            color: white;
            font-weight: bold;
        }

        .btn-custom:hover {
            background-color: #218838;
        }

        @media print {
            .no-print {
                display: none;
            }
        }

        .receipt {
            font-family: 'Courier New', Courier, monospace;
            width: 58mm;
            padding: 5px;
            border: 1px dashed black;
            margin: auto;
            text-align: center;
        }

        .receipt hr {
            border: none;
            border-top: 1px dashed black;
        }

        .receipt table {
            width: 100%;
            text-align: left;
        }
    </style>
</head>

<body class="container py-4">
    <div class="card p-4">
        <h2 class="text-center text-primary">Kasir - Kuat Jaya</h2>

        <!-- Input Scan Barcode -->
        <div class="input-group mb-3">
            <input type="text" id="barcode" class="form-control" placeholder="Scan Barcode..." autofocus onkeypress="if(event.keyCode==13) addProduct()">
            <!-- Tambahkan tombol Cari Barang -->
            <button class="btn btn-secondary w-100 mt-2" data-bs-toggle="modal" data-bs-target="#searchProductModal">Cari Barang</button>
        </div>

        <!-- Tabel Keranjang Belanja -->
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="cart"></tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total:</th>
                        <th id="totalPrice">Rp 0</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Input Pembayaran -->
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nominal Bayar:</label>
                <input type="number" id="payAmount" class="form-control" onkeyup="calculateChange()">
            </div>
            <div class="col-md-6">
                <label class="form-label">Kembalian:</label>
                <input type="text" id="changeAmount" class="form-control" readonly>
            </div>
        </div>

        <!-- Tombol Bayar & Cetak Struk -->
        <button class="btn btn-custom w-100 mt-3" onclick="processPayment()">Bayar & Cetak Struk</button>
    </div>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Kode Barcode:</label>
                    <input type="text" id="kodeBarcode" class="form-control">
                    <label class="form-label">Nama Produk:</label>
                    <input type="text" id="productName" class="form-control">
                    <label class="form-label">Harga:</label>
                    <input type="number" id="productPrice" class="form-control">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="saveProduct()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Struk Pembayaran -->
    <div id="receipt" class="receipt d-none">
        <h4>Kuat Jaya</h4>
        <p>Jl. Contoh No. 123, Jakarta</p>
        <hr>
        <table>
            <tbody id="receiptItems"></tbody>
        </table>
        <hr>
        <p><strong>Total:</strong> <span id="receiptTotal"></span></p>
        <p><strong>Bayar:</strong> <span id="receiptPaid"></span></p>
        <p><strong>Kembalian:</strong> <span id="receiptChange"></span></p>
        <hr>
        <p>Terima Kasih!</p>
    </div>

    <!-- Modal Pencarian Barang -->
    <div class="modal fade" id="searchProductModal" tabindex="-1" aria-labelledby="searchProductLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cari Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="searchQuery" class="form-control" placeholder="Masukkan nama barang..." onkeyup="searchProduct()">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="searchResults"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        let cart = [];

        function addProduct() {
            let barcode = document.getElementById('barcode').value;
            if (!barcode) return;

            fetch("<?= base_url('cashier/scan_barcode') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'barcode=' + barcode
                })
                .then(response => response.json())
                .then(product => {
                    if (product) {
                        let item = cart.find(p => p.barcode === product.barcode);
                        if (item) item.qty++;
                        else cart.push({
                            ...product,
                            qty: 1
                        });
                        updateCart();
                    } else {
                        let addProductModal = new bootstrap.Modal(document.getElementById('addProductModal'));
                        // document.getElementById('kodeBarcode').value(barcode);
                        addProductModal.show();
                        document.getElementById('kodeBarcode').value = barcode;
                    }
                    document.getElementById('barcode').value = '';
                });
        }

        function saveProduct() {
            let kbarcode = document.getElementById('kodeBarcode').value;
            let name = document.getElementById('productName').value;
            let price = document.getElementById('productPrice').value;

            if (!name || !price) {
                alert("Nama produk dan harga harus diisi!");
                return;
            }

            // Kirim data ke server untuk disimpan di database
            fetch("<?= base_url('cashier/save_product') ?>", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `name=${encodeURIComponent(name)}&price=${encodeURIComponent(price)}&kbarcode=${encodeURIComponent(kbarcode)}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Tambahkan produk ke keranjang setelah berhasil disimpan
                        cart.push({
                            id: data.id, // ID dari database
                            name,
                            price: parseInt(price),
                            qty: 1
                        });
                        updateCart();
                        document.getElementById('productName').value = '';
                        document.getElementById('productPrice').value = '';
                        document.getElementById('kodeBarcode').value = '';
                        bootstrap.Modal.getInstance(document.getElementById('addProductModal')).hide();
                        document.getElementById('barcode').focus();

                    } else {
                        alert("Gagal menyimpan produk!");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        }


        function updateCart() {
            let cartBody = document.getElementById('cart');
            cartBody.innerHTML = '';
            let total = 0;
            cart.forEach((item, index) => {
                let subtotal = item.price * item.qty;
                total += subtotal;
                cartBody.innerHTML += `<tr>
                    <td>${item.name}</td>
                    <td>Rp ${item.price.toLocaleString('id-ID')}</td>
                    <td><input type='number' class='form-control' value='${item.qty}' min='1' onchange='updateQty(${index}, this.value)'></td>
                    <td>Rp ${subtotal.toLocaleString('id-ID')}</td>
                    <td><button class='btn btn-danger btn-sm' onclick='removeItem(${index})'>Hapus</button></td>
                </tr>`;
            });
            document.getElementById('totalPrice').innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        function updateQty(index, newQty) {
            cart[index].qty = parseInt(newQty);
            updateCart();
        }

        function removeItem(index) {
            cart.splice(index, 1);
            updateCart();
        }

        function calculateChange() {
            let total = parseInt(document.getElementById('totalPrice').innerText.replace('Rp ', '').replaceAll('.', '')) || 0;
            let payAmount = parseInt(document.getElementById('payAmount').value) || 0;
            let change = payAmount - total;
            document.getElementById('changeAmount').value = change > 0 ? 'Rp ' + change.toLocaleString('id-ID') : 'Rp 0';
        }

        function resetForm() {
            document.getElementById('payAmount').value = '';
            document.getElementById('changeAmount').value = '';
            cart = [];
            updateCart();
        }

        function processPayment() {
            let total = parseInt(document.getElementById('totalPrice').innerText.replace('Rp ', '').replaceAll('.', '')) || 0;
            let paid = parseInt(document.getElementById('payAmount').value) || 0;
            let change = paid - total;

            if (paid < total) {
                alert("Nominal pembayaran kurang!");
                return;
            }

            saveTransaction(total, paid, change);
        }

        function searchProduct() {
            let query = document.getElementById('searchQuery').value.trim();
            if (query.length < 3) return;

            fetch("<?= base_url('cashier/search_product') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'query=' + encodeURIComponent(query)
                })
                .then(response => response.json())
                .then(data => {
                    let results = document.getElementById('searchResults');
                    results.innerHTML = '';
                    data.forEach(product => {
                        results.innerHTML += `<tr>
                        <td>${product.name}</td>
                        <td>Rp ${product.price.toLocaleString('id-ID')}</td>
                        <td><button class='btn btn-success btn-sm' onclick='addToCart(${JSON.stringify(product)})'>Pilih</button></td>
                    </tr>`;
                    });
                });
        }

        function addToCart(product) {
            if (!product || !product.id || !product.name || !product.price) {
                alert("Data barang tidak valid!");
                return;
            }

            let existing = cart.find(item => item.id === product.id);
            if (existing) {
                existing.qty++;
            } else {
                cart.push({
                    id: product.id,
                    name: product.name,
                    price: parseInt(product.price),
                    qty: 1
                });
            }

            updateCart(); // Pastikan daftar transaksi diperbarui

            // Tutup modal pencarian barang setelah memilih
            let searchModal = bootstrap.Modal.getInstance(document.getElementById('searchProductModal'));
            if (searchModal) {
                searchModal.hide();
            }
        }

        function saveTransaction(total, paid, change) {
            let transactionData = {
                total: total,
                paid: paid,
                change: change,
                items: cart
            };

            fetch("<?= base_url('cashier/save_transaction') ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(transactionData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        printReceipt(total, paid, change);
                        resetForm();
                    } else {
                        alert("Gagal menyimpan transaksi!");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        }

        function printReceipt(total, paid, change) {
            document.getElementById('receiptTotal').innerText = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('receiptPaid').innerText = 'Rp ' + paid.toLocaleString('id-ID');
            document.getElementById('receiptChange').innerText = 'Rp ' + change.toLocaleString('id-ID');

            let receiptBody = document.getElementById('receiptItems');
            receiptBody.innerHTML = '';
            cart.forEach(item => {
                receiptBody.innerHTML += `<tr>
                <td>${item.name}</td>
                <td>${item.qty}x</td>
                <td>Rp ${item.price.toLocaleString('id-ID')}</td>
            </tr>`;
            });

            let printWindow = window.open('', '_blank');
            printWindow.document.write(document.getElementById('receipt').outerHTML);
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        }
    </script>
</body>

</html>