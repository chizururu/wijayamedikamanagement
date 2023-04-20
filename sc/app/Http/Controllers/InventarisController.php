<?php

namespace App\Http\Controllers;

use App\Models\inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $inventaris = inventaris::all();
        return view('inventaris.index')->with('inventaris', $inventaris);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'jumlah_stok' => 'required',
            'harga_satuan' => 'required',
            'harga_jual' => 'required',
            'satuan' => 'required',
        ]);

        $inventaris = new inventaris();
        $inventaris->nama_barang = $validateData['nama_barang'];
        $inventaris->kategori_barang = $validateData['kategori_barang'];
        $inventaris->jumlah_stok = $validateData['jumlah_stok'];
        $inventaris->harga_satuan = $validateData['harga_satuan'];
        $inventaris->harga_jual = $validateData['harga_jual'];
        $inventaris->satuan = $validateData['satuan'];

        $inventaris->save();
        return redirect()->route('inventaris.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function show(inventaris $inventaris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function edit(inventaris $inventaris)
    {
        //
        return view('inventaris.index')->with('inventaris', $inventaris);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validateData = $request->validate([
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'jumlah_stok' => 'required',
            'harga_satuan' => 'required',
            'harga_jual' => 'required',
            'satuan' => 'required',
        ]);

        $inventaris = inventaris::find($id);
        if ($inventaris) {
            $inventaris->nama_barang = $validateData['nama_barang'];
            $inventaris->kategori_barang = $validateData['kategori_barang'];
            $inventaris->jumlah_stok = $validateData['jumlah_stok'];
            $inventaris->harga_satuan = $validateData['harga_satuan'];
            $inventaris->harga_jual = $validateData['harga_jual'];
            $inventaris->satuan = $validateData['satuan'];

            $inventaris->save();
            return redirect()->route('inventaris.index');
        } else {
            // handle case when inventaris doesn't exist
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $inventaris = inventaris::find($id);
        $inventaris->delete();
        return redirect()->route('inventaris.index');
    }
}
