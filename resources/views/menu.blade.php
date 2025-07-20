@extends('layouts.app')

@section('title', 'Semua Menu - Restorun')

@section('content')
<section class="container py-5" style="margin-top: 80px;">
    <div class="menu-header text-center mb-5">
        <h2>Semua Menu Kami</h2>
        <p>Temukan hidangan favorit Anda dari daftar lengkap kami.</p>
    </div>

    <div class="row">
        @forelse ($menuItems as $item)
            <div class="col-lg-4 col-md-6 my-4 text-center">
                <div class="card p-4 border-0 h-100" data-aos="fade-up">
                    <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" style="aspect-ratio: 1/1; object-fit: cover;" alt="{{ $item->name }}">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">{{ $item->name }}</h3>
                        <p class="card-text flex-grow-1">{{ $item->description }}</p>
                        <h3 class="mt-auto"><span>Rp {{ number_format($item->price, 0, ',', '.') }}</span></h3>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Maaf, belum ada menu yang tersedia saat ini.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $menuItems->links() }}
    </div>
</section>
@endsection
