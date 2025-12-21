@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow">
        <div class="card-body">

            <h4>Tambah Inventaris</h4>

            <form action="/inventaris/store" method="POST">
                @csrf

                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control">

                <label class="mt-3">Tipe (opsional)</label>
                <input type="text" name="tipe" class="form-control">

                <label class="mt-3">Jumlah</label>
                <input type="number" name="jumlah" class="form-control">

                <label class="mt-3">Lokasi</label>
                <input type="text" name="lokasi" class="form-control">

                <label class="mt-3">Tanggal</label>
                <input type="date" name="tanggal_masuk" class="form-control">

                <label class="mt-3">Kondisi</label>
                <select name="kondisi" id="kondisi" class="form-control">
                <option value="baru">Baru</option>
                <option value="baik">Baik</option>
                <option value="rusak">Rusak</option>
                <option value="dipinjam">Dipinjam</option>
                </select>

                <label class="mt-3">Keterangan (opsional)</label>
                <textarea name="keterangan" class="form-control"></textarea>

                <button class="btn btn-primary mt-3">Simpan</button>
            </form>

        </div>
    </div>

</div>
@endsection
