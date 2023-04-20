@extends('index')

@section('title', 'Inventaris')
@section('content')
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Harga Jual</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Harga Jual</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @foreach($inventaris as $items)
                        <tr>
                            <td>{{$items->id}}</td>
                            <td>{{$items->nama_barang}}</td>
                            <td>{{$items->kategori_barang}}</td>
                            <td>{{$items->jumlah_stok}}</td>
                            <td>{{$items->harga_satuan}}</td>
                            <td>{{$items->harga_jual}}</td>
                            <td>{{$items->satuan}}</td>
                            <td><button class="btn btn-warning btn-sm edit-barang" data-toggle="modal" data-target="#editBarang{{ $items->id  }}"><i class="bi bi-pencil-fill"></i></button>
                                <button class="btn btn-danger btn-sm delete-barang" data-toggle="modal" data-id="{{ $items->id }}" data-nama="{{ $items->nama_barang }}" data-target="#deleteBarang"><i class="bi bi-trash-fill"></i></button></td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Membuat Modal Create Barang--}}
    <div class="modal fade" id="createBarang" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold px-2">Add Barang</h5>
                </div>
                <div class="modal-body p-2">
                    <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                                <label for="kategori_barang" class="form-label">Kategori</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="kategori_barang">
                            </div>
                        </div>
                        <div class="row g-3 p-2">
                            <div class="col">
                                <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="jumlah_stok">
                            </div>
                            <div class="col">
                                <label for="satuan" class="form-label">Satuan</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="satuan">
                            </div>
                        </div>
                        <div class="row g-3 p-2">
                            <div class="col">
                                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="harga_satuan">
                            </div>
                            <div class="col">
                                <label for="harga_jual" class="form-label">Harga Jual</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="harga_jual">
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
    {{-- Membuat Modal Edit Barang--}}
    @foreach($inventaris as $inventaris)
        <div class="modal fade" id="editBarang{{ $inventaris->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $inventaris->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold px-2">Edit Barang</h5>
                    </div>
                    <div class="modal-body p-2">
                        <form action="{{ route('inventaris.update', ['inventari' => $inventaris->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-3 p-2">
                                <div class="col col-sm-3">
                                    <label for="nama_barang"class="form-label">Nama Barang</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="nama_barang" value="{{ $inventaris->nama_barang }}">
                                </div>
                            </div>
                            <div class="row g-3 p-2">
                                <div class="col col-sm-3">
                                    <label for="kategori_barang" class="form-label">Kategori</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="kategori_barang" value="{{ $inventaris->kategori_barang }}">
                                </div>
                            </div>
                            <div class="row g-3 p-2">
                                <div class="col">
                                    <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="jumlah_stok" value="{{ $inventaris->jumlah_stok }}">
                                </div>
                                <div class="col">
                                    <label for="satuan" class="form-label">Satuan</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="satuan" value="{{ $inventaris->satuan }}">
                                </div>
                            </div>
                            <div class="row g-3 p-2">
                                <div class="col">
                                    <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="harga_satuan" value="{{ $inventaris->harga_satuan  }}">
                                </div>
                                <div class="col">
                                    <label for="harga_jual" class="form-label">Harga Jual</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="harga_jual" value="{{ $inventaris->harga_jual }}">
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
    @endforeach
    {{-- Membuat Modal Delete Barang--}}
    <div class="modal fade" id="deleteBarang" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold px-2">Delete Barang</h5>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formModalDelete">
                        @method('DELETE')
                        @csrf
                        <div class="p-2">
                            <p class="text-center">Apakah anda ingin menghapus barang : <span class="font-weight-bold" id="namaBarang"></span> !</p>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $('.delete-barang').click(function () {
            let id = $(this).attr('data-id')
            $('#formModalDelete').attr('action', '/inventaris/' + id);
            let nama = $(this).attr('data-nama');
            $('#namaBarang').text(nama);
            console.log(id);
            console.log(nama);

        });
        $('#formModalDelete [type="submit"]').click(function () {
           $('#formModalDelete').submit();
        });
    </script>

@endsection
