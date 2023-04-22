@extends('index')

@section('content')
    <div class="container-fluid">
        {{--Page Heading = Judul Page--}}
        <h1 class="h3 mb-4 text-gray-800">Daftar Transaksi</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold">Informasi Pelanggan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <div class="row mb-2">
                        <label class="col-sm-4 col-form-label">Nama Pelanggan</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-4 col-form-label">Total Harga</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="total_harga" name="total_harga">
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        {{--  Table Barang --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
            </div>
            <div class="p-3">
                <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#createBarang">
                    <span class="icon text-white"><i class="bi bi-plus-lg"></i></span>
                    <span class="text">Tambah Barang</span>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Satuan Harga</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Satuan Harga</th>
                                <th>Total Harga</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--Modal Add Barang--}}

    {{--Modal Edit Barang--}}
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
    {{--Modal Add Barang--}}
    <div class="modal fade" id="createBarang" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold px-2">Add Barang</h5>
                </div>
                <div class="modal-body p-2">
                    <form>
                        <div class="row g-3 p-2">
                            <div class="col col-sm-3">
                                <label for="nama_barang"class="form-label">Nama Barang</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="nama_barang">
                            </div>
                        </div>
                        <div class="row g-3 p-2">
                            <div class="col col-sm-3">
                                <label for="nama_barang"class="form-label">Nama Barang</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="nama_barang">
                            </div>
                        </div>
                        <div class="row g-3 p-2">
                            <div class="col col-sm-3">
                                <label for="nama_barang"class="form-label">Nama Barang</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="nama_barang">
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--Modal Hapus Barang--}}
@endsection
