@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')

@section('title', 'Berita Nasional - Detik News')

@section('content')

<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    .news-container {
        max-width: 1250px;
        margin: auto;
        padding: 30px 15px;
    }

    /* HEADER CARD */
    .card-custom {
        background: white;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        margin-bottom: 35px;
    }

    .card-header-custom {
        background: linear-gradient(135deg, #0077ff, #00d4a5);
        padding: 22px 28px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header-custom h2 {
        font-size: 24px;
        font-weight: 600;
    }

    .btn-back {
        background: rgba(255,255,255,0.25);
        padding: 10px 22px;
        border-radius: 30px;
        color: white;
        text-decoration: none;
        font-weight: 500;
        transition: 0.3s;
        backdrop-filter: blur(6px);
        border: 1px solid rgba(255,255,255,0.4);
    }
    .btn-back:hover { background: rgba(255,255,255,.1); }

    /* HIGHLIGHT */
    .highlight-card { margin-bottom: 35px; }

    .highlight-wrapper {
        display: flex;
        gap: 22px;
        background: white;
        box-shadow: 0 15px 35px rgba(0,0,0,0.07);
        border-radius: 18px;
        text-decoration: none;
        color: inherit;
        overflow: hidden;
        transition: .3s;
    }
    .highlight-wrapper:hover { transform: translateY(-6px); }

    .highlight-img {
        width: 45%;
        height: 280px;
        object-fit: cover;
    }

    .highlight-content { padding: 22px; width: 55%; }

    .highlight-tag {
        background: #ff4040;
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .highlight-title {
        font-size: 24px;
        color: #003366;
        margin: 14px 0 10px;
        font-weight: 700;
        line-height: 1.3;
    }

    .highlight-desc {
        font-size: 14px;
        color: #555;
    }

    .highlight-date {
        margin-top: 12px;
        background: #e8f3ff;
        padding: 6px 12px;
        display: inline-block;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        color: #0077ff;
    }

    /* GRID BERITA */
    .news-grid {
        margin-top: 25px;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 25px;
    }

    .news-item {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        box-shadow: 0 10px 25px rgba(0,0,0,0.06);
        transition: .3s ease;
    }

    .news-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 45px rgba(0,0,0,0.12);
    }

    .news-item img {
        width: 100%;
        height: 190px;
        object-fit: cover;
    }

    .content { padding: 16px 18px 20px; }

    .content h3 {
        font-size: 17px;
        font-weight: 600;
        color: #004c99;
        line-height: 1.4;
        margin-bottom: 6px;
    }

    .content p {
        font-size: 13px;
        color: #555;
        margin-bottom: 10px;
    }

    .news-date {
        display: inline-block;
        margin-top: 6px;
        padding: 4px 10px;
        font-size: 12px;
        color: #0077ff;
        background: #e8f3ff;
        border-radius: 20px;
        font-weight: 600;
    }

    /* Responsive */
    @media(max-width: 768px) {
        .highlight-wrapper { flex-direction: column; }
        .highlight-img {
            width: 100%;
            height: 220px;
        }
        .highlight-content { width: 100%; }
    }
</style>

<div class="news-container">

    <div class="card-custom">

        <div class="card-header-custom">
            <h2>
                <i class="fas fa-newspaper"></i> Berita Nasional — Detik News
            </h2>

            <a href="{{ url('/berita') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Berita Desa
            </a>
        </div>

        <div class="card-body">

            {{-- ===================== HIGHLIGHT BERITA ===================== --}}
            @if(count($news) > 0)
                @php $highlight = $news[0]; @endphp

                <div class="highlight-card">
                    <a href="{{ $highlight['link'] }}" target="_blank" class="highlight-wrapper">

                        <img src="{{ $highlight['image'] }}" class="highlight-img">

                        <div class="highlight-content">
                            <span class="highlight-tag">🔥 Highlight</span>

                            <h2 class="highlight-title">{{ $highlight['title'] }}</h2>

                            <p class="highlight-desc">
                                {{ Str::limit(strip_tags($highlight['description'] ?? ''), 150) }}
                            </p>

                            <div class="highlight-date">
                                Detik.com • {{ $highlight['date'] ?? 'Hari ini' }}
                            </div>
                        </div>

                    </a>
                </div>
            @endif

            {{-- ===================== LIST BERITA ===================== --}}
            <div class="news-grid">

                @foreach($news as $item)
                    <a href="{{ $item['link'] }}" target="_blank" class="news-item">

                        <img src="{{ $item['image'] ?? 'https://via.placeholder.com/400x250?text=No+Image' }}">

                        <div class="content">
                            <h3>{{ $item['title'] }}</h3>

                            <p>{{ Str::limit(strip_tags($item['description'] ?? ''), 100) }}</p>

                            <div class="news-date">
                                Detik.com • {{ $item['date'] ?? 'Hari ini' }}
                            </div>
                        </div>

                    </a>
                @endforeach

            </div>

        </div>

    </div>

</div>

@endsection
