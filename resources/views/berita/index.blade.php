@extends('layouts.app')

@section('content')

<style>
/* ===========================
   HIGHLIGHT NEWS
=========================== */
.highlight-wrapper {
    display: flex;
    flex-wrap: wrap;
    background: white;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 12px 35px rgba(0,0,0,.08);
    margin-bottom: 30px;
    transition: .3s;
    text-decoration: none;
    color: inherit;
}

.highlight-wrapper:hover { transform: translateY(-6px); }

.highlight-img {
    width: 45%;
    height: 280px;
    object-fit: cover;
}

.highlight-content {
    padding: 22px;
    width: 55%;
}

.highlight-tag {
    background: #ff4040;
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 13px;
}

.highlight-title {
    font-size: 24px;
    margin-top: 12px;
    font-weight: 700;
    color: #003366;
}

.highlight-desc {
    margin-top: 10px;
    color: #555;
    font-size: 14px;
}

.highlight-date {
    margin-top: 12px;
    padding: 6px 12px;
    background: #e8f3ff;
    border-radius: 15px;
    font-weight: 600;
    color: #0077ff;
    display: inline-block;
}

/* ===========================
   NEWS GRID
=========================== */
.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px,1fr));
    gap: 25px;
    margin-top: 30px;
}

.news-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,.07);
    text-decoration: none;
    color: inherit;
    transition: .3s;
}
.news-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 45px rgba(0,0,0,.12);
}

.news-card img {
    width: 100%;
    height: 190px;
    object-fit: cover;
}

.news-body { padding: 15px; }

.news-title {
    font-size: 17px;
    font-weight: 600;
    color: #004c99;
    margin-bottom: 6px;
}

.news-desc {
    color: #555;
    font-size: 13px;
}

.news-date {
    margin-top: 6px;
    background: #e8f3ff;
    color: #0077ff;
    padding: 4px 10px;
    border-radius: 15px;
    display: inline-block;
    font-size: 12px;
    font-weight: 600;
}

/* ===========================
   RESPONSIVE
=========================== */
@media (max-width: 992px) {
    .highlight-img {
        width: 100%;
        height: 230px;
    }
    .highlight-content {
        width: 100%;
    }
}

@media (max-width: 768px) {
    .highlight-wrapper {
        flex-direction: column;
    }
    .highlight-img {
        height: 210px;
    }
    .highlight-title { font-size: 20px; }
}

@media (max-width: 576px) {
    .highlight-img {
        height: 180px;
    }
    .news-grid {
        grid-template-columns: 1fr;
    }
}
</style>


<div class="container mt-4">

    {{-- TOMBOL TAMBAH BERITA --}}
    @if(auth()->check())
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('berita.create') }}" 
           class="btn btn-primary"
           style="font-weight:600; border-radius:10px;">
            + Tambah Berita
        </a>
    </div>
    @endif


    {{-- HIGHLIGHT --}}
    @if(count($data) > 0)
        @php $highlight = $data[0]; @endphp

        <a href="{{ route('berita.show', $highlight->id) }}" class="highlight-wrapper">

            <img src="{{ $highlight->gambar ? asset('storage/'.$highlight->gambar) : 'https://via.placeholder.com/600x400?text=No+Image' }}"
                 class="highlight-img">

            <div class="highlight-content">
                <span class="highlight-tag">🔥 Highlight</span>

                <h2 class="highlight-title">{{ $highlight->judul }}</h2>

                <p class="highlight-desc">
                    {{ Str::limit(strip_tags($highlight->isi), 150) }}
                </p>

                <div class="highlight-date">
                    {{ $highlight->created_at->format('d M Y') }}
                </div>
            </div>

        </a>
    @endif


    {{-- GRID BERITA --}}
    <div class="news-grid">

        @foreach($data as $item)

        <div class="news-card-wrapper">

            <a href="{{ route('berita.show', $item->id) }}" class="news-card">

                <img src="{{ $item->gambar ? asset('storage/'.$item->gambar) : 'https://via.placeholder.com/400x250?text=No+Image' }}">

                <div class="news-body">
                    <h3 class="news-title">{{ $item->judul }}</h3>

                    <p class="news-desc">{{ Str::limit(strip_tags($item->isi), 80) }}</p>

                    <div class="news-date">
                        {{ $item->created_at->format('d M Y') }}
                    </div>
                </div>

            </a>

            {{-- Tombol Admin --}}
            @if(auth()->check() && auth()->user()->role === 'admin')
                <div class="mt-2 d-flex gap-2">

                    <a href="{{ route('berita.edit', $item->id) }}"
                        class="btn btn-warning btn-sm" style="border-radius:8px;">
                        Edit
                    </a>

                    <form action="{{ route('berita.destroy', $item->id) }}" method="POST"
                          onsubmit="return confirm('Yakin hapus berita ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" style="border-radius:8px;">
                            Delete
                        </button>
                    </form>

                </div>
            @endif

        </div>

        @endforeach

    </div>


</div>

@endsection
