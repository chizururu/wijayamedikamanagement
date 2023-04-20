@extends('index')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Informasi Pembeli</h5>
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label">Nama Pelanggan</label>
                <div class="col-sm-7">
                    <input type="text" id="nama_pelanggan" class="form-control">
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-sm-7">
                    <input type="text" id="alamat" class="form-control">
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label">Nomor Telepon</label>
                <div class="col-sm-7">
                    <input type="text" id="telephone" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row py-2">
                <div class="col">
                    <h5 class="card-title">Rincian Pesanan</h5>
                </div>
                <div class="col-sm-1 py-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddBarang"><i class="bi bi-bookmark-plus-fill"></i></button>
                </div>
            </div>
            <table id="tableBarang" class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <body>

                </body>
            </table>
            <hr class="mt-4">
            <div class="px-2">
                <div class="">
                    <div class="row justify-content-end mb-2">
                        <label class="col-sm-3 col-form-label">Total Bayar</label>
                        <div class="col-sm-1 col-form-label" id="totalBayar"> 0
                        </div>
                    </div>
                    <div class="row justify-content-end mb-2">
                        <label class="col-sm-3 col-form-label">Payment Cash</label>
                        <div class="col-sm-1 col-form-label">
                            <input type="text" id="pembayaran" class="form-control" onkeyup="inputBayar(this.value)">
                        </div>
                    </div>
                    <div class="row justify-content-end mb-2">
                        <label class="col-sm-3 col-form-label">Change</label>
                        <div class="col-sm-1 col-form-label">
                            <div id="change">50000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Modals Form Add Barans-->
    <div class="modal fade" id="modalAddBarang" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Add Barang</h6>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang">
                        </div>
                        <div class="col-12">
                            <label for="harga_satuan" class="form-label">Harga Satuan</label>
                            <input type="number" class="form-control" id="harga_satuan" min="0" required oninput="modalAddSubTotal()">
                        </div>
                        <div class="col-12">
                            <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                            <input type="number" class="form-control" id="jumlah_barang" min="0" required oninput="modalAddSubTotal()">
                        </div>
                        <div class="col-12">
                            <label for="sub_harga" class="form-label">Sub Harga</label>
                            <div id="sub_harga">0</div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="reset" data-bs-dismiss="modal" aria-label="Close" onclick="addBarang()">Submit</button>
                            <button type="reset" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close" onclick="cancelBarang()">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Form Edit Barangs-->
    <div class="modal fade" id="modalEditBarang" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Barang</h6>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="edit_nama_barang">
                        </div>
                        <div class="col-12">
                            <label for="harga_satuan" class="form-label">Harga Satuan</label>
                            <input type="number" class="form-control" id="edit_harga_satuan" required oninput="modalEditBarang(this)">
                        </div>
                        <div class="col-12">
                            <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                            <input type="number" class="form-control" id="edit_jumlah_barang" required oninput="modalEditBarang(this)">
                        </div>
                        <div class="col-12">
                            <label for="sub_harga" class="form-label">Sub Harga</label>
                            <div id="edit_sub_harga"></div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="reset" data-bs-dismiss="modal" aria-label="Close" onclick="updateBarang(this)">Submit</button>
                            <button type="reset" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close" onclick="cancelBarang()">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Script-->
    <script>
        let daftarBarang = [];
        let selectedRow; // define selectedRow outside the functions
        function modalAddSubTotal() {
            const harga = document.getElementById("harga_satuan").value;
            const jumlah = document.getElementById("jumlah_barang").value;

            const subTotal = harga * jumlah;
            document.getElementById("sub_harga").innerHTML = subTotal;
        }
        /*Menampilkan Modal Add Barang*/
        function addBarang() {
            const namaBarang = document.getElementById("nama_barang").value;
            const hargaBarang = document.getElementById("harga_satuan").value;
            const jumlahBarang = document.getElementById("jumlah_barang").value;
            const subHarga = hargaBarang*jumlahBarang;

            document.getElementById("sub_harga").innerHTML = subHarga;
            const barang = {id : daftarBarang.length +1, nama : namaBarang, harga : hargaBarang, jumlah : jumlahBarang, subHrg : subHarga}
            daftarBarang.push(barang);

            document.getElementById("nama_barang").value = '';
            document.getElementById("harga_satuan").value = '';
            document.getElementById("jumlah_barang").value = '';
            document.getElementById("sub_harga").innerHTML = 0;
            totalBayar();
            dataTable();
        }

        /*Menghapus isi value pada Add Modal ketika user membatalkan input barang*/
        function cancelBarang () {
            document.getElementById("nama_barang").value = '';
            document.getElementById("harga_satuan").value = '';
            document.getElementById("jumlah_barang").value = '';
            document.getElementById("sub_harga").innerHTML = 0;
        }

        function totalBayar() {
            var totalHarga = 0;

            for (var i = 0; i < daftarBarang.length; i++) {
                totalHarga += daftarBarang[i].jumlah * daftarBarang[i].harga;
                console.log(daftarBarang);
            }
            console.log(totalHarga);
            document.getElementById("totalBayar").innerHTML = totalHarga;
        }
        /*Menampilkan isi Daftar Barang kedalam table daftar barang*/
        function dataTable() {
            const table = document.getElementById("tableBarang");
            const row = table.insertRow();

            const index = row.insertCell(0);
            const namaBarang = row.insertCell(1);
            const hargaSatuan = row.insertCell(2);
            const jumlahBarang = row.insertCell(3);
            const subTotal = row.insertCell(4);
            const action = row.insertCell(5);

            for (var i = 0; i < daftarBarang.length; i++) {
                console.log(daftarBarang[i].nama);
                namaBarang.innerHTML = daftarBarang[i].nama;
                console.log(daftarBarang[i].harga);
                hargaSatuan.innerHTML = daftarBarang[i].harga;
                console.log(daftarBarang[i].jumlah);
                jumlahBarang.innerHTML = daftarBarang[i].jumlah;
                console.log(daftarBarang[i].subHrg);
                subTotal.innerHTML = daftarBarang[i].subHrg;
                action.innerHTML = '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditBarang" onclick="editBarang(this)"><i class="bi bi-pen-fill"></i></button>' + ' ' + '<button type="button" class="btn btn-danger" onclick="deleteBarang(this)"><i class="bi bi-x-circle"></i></button>'
            }
        }
        function modalEditBarang() {
            const harga = document.getElementById("edit_harga_satuan").value;

            const jumlah = document.getElementById("edit_jumlah_barang").value;

            const subTotal = harga * jumlah;
            document.getElementById("edit_sub_harga").innerHTML = subTotal;
        }
        /*Menampilkan Modal Edit Barang*/
        function editBarang(button) {
            const row = button.parentNode.parentNode;
            const cells = row.cells;

            const namaBarang = cells[1].innerHTML;
            const hargaSatuan = cells[2].innerHTML;
            const jumlahSatuan = cells[3].innerHTML;
            const subTotal = hargaSatuan*jumlahSatuan;
            document.getElementById("edit_nama_barang").value = namaBarang;
            document.getElementById("edit_harga_satuan").value = hargaSatuan;
            document.getElementById("edit_jumlah_barang").value = jumlahSatuan;
            document.getElementById("edit_sub_harga").innerHTML = subTotal;
        }
        function updateBarang() {
            const namaBarang = document.getElementById("edit_nama_barang").value;
            const hargaSatuan = document.getElementById("edit_harga_satuan").value;
            const jumlah = document.getElementById("edit_jumlah_barang").value;
            const subHarga = hargaSatuan * jumlah;
            const table = document.getElementById("tableBarang");

            console.log(table)
            console.log(selectedRow  );
        }
        /*Menghapus isi Daftar Barang dalam table*/
        function deleteBarang(button) {
            const tableRow = button.parentNode.parentNode;
            const row = tableRow.rowIndex;
            daftarBarang.splice(row - 1, 1);
            tableRow.parentNode.removeChild(tableRow);
            totalBayar();
            dataTable();
        }
    </script>
@endsection
