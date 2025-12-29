@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card shadow">
        <!-- CARD HEADER DENGAN GRADIASI -->
        <div class="card-header text-white" 
             style="background: linear-gradient(120deg, #0099cc, #00d4b0);">
            <h4 class="mb-0">Edit Data Inventaris</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('inventaris.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" 
                           value="{{ $item->nama_barang }}" required>
                </div>

                <div class="mb-3">
                    <label>Tipe</label>
                    <input type="text" name="tipe" class="form-control" 
                           value="{{ $item->tipe }}">
                </div>

                <div class="mb-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" 
                           value="{{ $item->jumlah }}" required>
                </div>

                <div class="mb-3">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" 
                           value="{{ $item->lokasi }}">
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal_masuk" class="form-control" 
                           value="{{ $item->tanggal_masuk }}" required>
                </div>

                <div class="mb-3">
    <label>Kondisi</label>
    <select name="kondisi" id="kondisi" class="form-control" required>
        <option value="baru" {{ $item->kondisi == 'baru' ? 'selected' : '' }}>Baru</option>
        <option value="baik" {{ $item->kondisi == 'baik' ? 'selected' : '' }}>Baik</option>
        <option value="rusak" {{ $item->kondisi == 'rusak' ? 'selected' : '' }}>Rusak</option>
        <option value="dipinjam" {{ $item->kondisi == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
    </select>
</div>
<div class="mb-3">
    <label>Keterangan</label>
    <textarea name="keterangan" class="form-control"
        placeholder="Keterangan tambahan">{{ $item->keterangan }}</textarea>
</div>



                <button class="btn btn-primary">Simpan Perubahan</button>
                <a href="/inventaris" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

</div>
@endsection
