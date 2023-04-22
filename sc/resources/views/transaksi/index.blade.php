@extends('index')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Laporan Transaksi</h1>
        <p class="mb-4">Date Runing</p>
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold">Filter Search Tanggal</h6>
            </div>
            <div class="card-body">
                <form action="/transaksi" method="{{ route('transaksi.index') }}">
                    <label for="tanggal">Pilih Tanggal</label>
                    <div class="row">
                        <div class="col">
                            <input class="form-control" type="date" name="tanggal" value="{{ request()->input('tanggal') ?? date('Y-m-d') }}">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Search</button>
                            @if($tanggal)
                                <a href="{{ route('transaksi.index') }}" class="btn btn-warning">Reset</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pelanggan</h6>
            </div>
            <div class="p-3">
                <button type="button" class="btn btn-primary btn-icon-split" onclick="location.href='{{ url('transaksi/create') }}'">
                    <span class="icon text-white"><i class="bi bi-plus-lg"></i></span>
                    <span class="text">Tambah Transaksi</span>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tanggal</th>
                            <th>Nama Pelanggan</th>
                            <th>Total Bayar</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Tanggal</th>
                            <th>Nama Pelanggan</th>
                            <th>Total Bayar</th>
                        </tr>
                        </tfoot>
                        <tbody>
                            @foreach($transaksi as $items)
                                <tr>
                                    <td>{{ $items->id }}</td>
                                    <td>{{ $items->created_at }}</td>
                                    <td>{{ $items->nama_pelanggan }}</td>
                                    <td>{{ $items->total_harga }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->
    <script>
        if(window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
@endsection
