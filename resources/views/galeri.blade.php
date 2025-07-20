@extends('layouts.app')

@section('title', 'Galeri - Restorun')

@section('content')
<section class="container py-5" style="margin-top: 80px;">
    <div class="menu-header text-center mb-5">
        <h2>Galeri Restoran Kami</h2>
        <p>Lihat momen-momen spesial yang tertangkap kamera di restoran kami.</p>
    </div>

    <div class="row g-4">
        @forelse ($galleryItems as $photo)
            <div class="col-lg-4 col-md-6">
                <div class="card overflow-hidden" data-aos="zoom-in">
                    <img src="{{ Storage::url($photo->image) }}" class="img-fluid" style="aspect-ratio: 4/3; object-fit: cover;" alt="{{ $photo->title ?? 'Foto Galeri' }}">
                    @if($photo->caption)
                    <div class="card-body text-center py-2">
                        <p class="card-text small text-muted">{{ $photo->caption }}</p>
                    </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Maaf, belum ada foto di galeri saat ini.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $galleryItems->links() }}
    </div>
</section>
@endsection
