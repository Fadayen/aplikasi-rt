@extends('layouts.app')

@section('content')

<style>
.detail-container {
    background: linear-gradient(135deg, #ffffff);
    padding: 20px 10px;
    display: flex;
    justify-content: center;
}

.detail-box {
    background: #ffffff;
    width: 92%;
    max-width: 1100px;
    border-radius: 20px;
    padding: 0;
    overflow: hidden;
    box-shadow: 0 4px 25px rgba(0,0,0,0.08);
}

/* HEADER */
.detail-header {
    background: linear-gradient(120deg, #0099cc, #00d4b0);
    padding: 18px 15px 25px;
    text-align: center;
    color: white;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
}

.detail-title {
    font-size: 26px;
    font-weight: 800;
}

.line {
    width: 80px;
    height: 3px;
    background: rgba(255,255,255,0.9);
    margin: 10px auto 0;
    border-radius: 3px;
}

/* CONTENT */
.detail-content {
    padding: 22px;
}

.berita-header {
    font-size: 13px;
    color: #666;
    margin-bottom: 15px;
}

.berita-judul {
    font-size: 28px;
    font-weight: 900;
    color: #0d2740;
    margin-bottom: 18px;
}

.berita-isi {
    font-size: 16px;
    line-height: 1.8;
}

/* KOMENTAR */
.komentar-box {
    background: #f9f9f9;
    border-radius: 18px;
    padding: 20px;
    margin-top: 35px;
    border: 1px solid #eee;
}

.komentar-item {
    padding: 12px 0;
    border-bottom: 1px solid #e1e1e1;
}

.komentar-item b {
    color: #0099cc;
}

/* INPUT */
.input-wrapper {
    margin-top: 15px;
    display: flex;
    gap: 12px;
    border: 2px solid #00d4b0;
    border-radius: 15px;
    padding: 8px 12px;
    background: #e6fffa;
}

.input-wrapper input {
    border: none;
    background: transparent;
    width: 100%;
    outline: none;
}

.btn-send {
    background: linear-gradient(120deg, #00b4a8, #00e4cc);
    color: white;
    padding: 8px 18px;
    border-radius: 10px;
    border: none;
    cursor: pointer;
}

/* MODAL IMAGE */
.img-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.9);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}

.img-modal img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 12px;
}

.img-close {
    position: absolute;
    top: 20px;
    right: 30px;
    font-size: 40px;
    color: white;
    cursor: pointer;
}
</style>

<a href="/berita" class="btn btn-secondary mb-3">← Kembali</a>

<div class="detail-container">
    <div class="detail-box">

        <div class="detail-header">
            <div class="detail-title">DETAIL BERITA</div>
            <div class="line"></div>
        </div>

        <div class="detail-content">

            <div class="berita-header">
                {{ $data->penulis }} • {{ $data->created_at->format('Y-m-d H:i:s') }}
            </div>

            {{-- GAMBAR (CLICK TO FULL) --}}
            @if($data->gambar)
                <img src="{{ asset('storage/' . $data->gambar) }}"
                     onclick="showImg(this.src)"
                     style="width:100%; max-height:350px; object-fit:cover; border-radius:15px; margin-bottom:15px; cursor:pointer;">
            @endif

            <div class="berita-judul">{{ $data->judul }}</div>
            <div class="berita-isi">{!! nl2br(e($data->isi)) !!}</div>

            {{-- KOMENTAR --}}
            <div class="komentar-box">
                @foreach($komentar as $k)
                    <div class="komentar-item">
                        <b>{{ $k->nama }}</b> • {{ $k->created_at->format('Y-m-d H:i:s') }}<br>
                        {{ $k->isi }}
                    </div>
                @endforeach

                <form action="{{ url('/berita/'.$data->id.'/komentar') }}" method="POST">
                    @csrf
                    <div class="input-wrapper">
                        <input type="text" name="isi" placeholder="Type Message ..." required>
                        <button class="btn-send">Kirim</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- MODAL FULL IMAGE -->
<div id="imgModal" class="img-modal" onclick="closeImg()">
    <span class="img-close">&times;</span>
    <img id="imgPreview">
</div>

<script>
function showImg(src) {
    document.getElementById('imgModal').style.display = 'flex';
    document.getElementById('imgPreview').src = src;
}

function closeImg() {
    document.getElementById('imgModal').style.display = 'none';
}
</script>

@endsection
