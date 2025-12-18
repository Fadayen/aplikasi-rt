@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow">
        <div class="card-body">
            <h4>Tambah Data Keuangan</h4>

            <form action="/keuangan/store" method="POST">
                @csrf

                <label>Kegiatan</label>
                <input type="text" name="kegiatan" class="form-control">

                <label class="mt-3">Jumlah</label>
                <input type="number" name="jumlah" class="form-control">

                <label class="mt-3">Jenis</label>
                <select name="jenis" class="form-control">
                    <option value="pemasukan">Pemasukan</option>
                    <option value="pengeluaran">Pengeluaran</option>
                </select>

                <label class="mt-3">Tanggal</label>
                <input type="date" name="tanggal" class="form-control">

                <label class="mt-3">Keterangan (opsional)</label>
                <textarea name="keterangan" class="form-control"></textarea>

                <button class="btn btn-primary mt-3">Simpan</button>
            </form>
        </div>
    </div>

</div>
@endsection
