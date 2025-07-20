@extends('layouts.app')

@section('content')
    <section class="hero p-5 text-center text-lg-start align-items-center bg-light" style="margin-top: 60px;">
        <div class="container">
            <div class="row flex-lg-row-reverse align-items-center d-flex justify-content-center g-5 py-5">
                <div class="col-sm-8 col-lg-6" data-aos="zoom-out">
                   <img src="{{ asset('images/dashboard1.jpg') }}" class="img-fluid" id="mie-ayam-img" alt="Mie Ayam Bakso Kang Naryo" data-aos-delay="300">
                </div>
                <div class="col-lg-6" data-aos="fade-up">
                    <h2 class="">Rasa Juara, Selalu Jadi Andalan</h2>
                    <p class="lead">Lapar melanda? Rindu semangkuk mie ayam hangat atau bakso dengan kuah gurih? Di Pondok Makan Kang Naryo, kami sajikan cita rasa otentik yang siap memuaskan selera Anda, kapan saja.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container about py-5" id="about" data-aos="fade-up">
        <div class="about-header text-center">
            <h2>Tentang Kami</h2>
            <p>Kenali Lebih Jauh <span>Tentang Kami</span></p>
        </div>

        <div class="row mt-4">
    <div class="row mt-4">
    <div class="col-lg-7 col-sm-12 position-relative">

        <img src="{{ asset('images/dashboard2.jpg') }}" class="w-100 rounded shadow" alt="Warung Kang Naryo">

        <div class="position-absolute top-0 start-0 m-3 p-3 bg-dark bg-opacity-75 rounded">
            <h4 class="text-white mb-1" style="font-family: 'Poppins', sans-serif;">Pesan Sekarang</h4>
            <p class="text-white fw-bold mb-0 fs-5">+62 812-3456-7890</p>
        </div>

    </div>

    <div class="col-lg-5 col-sm-12 d-flex align-items-center">
        <div class="ps-lg-4">
            <p><strong>Pondok Makan KangNaryo.</strong> Terletak strategis di Jl. Dongkelan 353, Pondok Makan Batas Kota "Kang Naryo" adalah destinasi andalan Anda untuk menikmati sajian kuliner favorit yang lezat, beragam, dan ramah di kantong. Sesuai dengan nama kami, kami menjadi titik temu para perikmat rasa di perbatasan kota Yogyakarta.<br><br> Dengan semangat "Kang Naryo" yang akrab dan bersahabat, kami berkomitmen untuk menyajikan hidangan yang dimasak dengan sepenuh hati, memastikan setiap mangkuknya memberikan kepuasan dan kehangatan.<br><br> Salah satu komitmen utama kami adalah menyediakan makanan berkualitas dengan harga yang jujur ​​dan terjangkau. Kami ingin semua orang bisa menikmati hidangan lezat tanpa perlu khawatir. Apakah Anda sedang mencari makan siang yang cepat, makan malam yang mengenyangkan, atau sekadar mampir untuk melepas lapar, Pondok Makan Batas Kota "Kang Naryo" adalah pilihan yang tepat.</p>
        </div>
    </div>
</div>
    </section>

    <section class="menu bg-light py-5" id="menu-preview" data-aos="fade-up">
        <div class="container">
            <div class="menu-header text-center">
                <h2>Menu Pilihan Kami</h2>
            </div>

            {{-- Grid Container (Bootstrap) --}}
            <div class="row g-4 mt-4">

                @forelse ($menuItems as $item)
                    {{-- Grid Item (Kolom Bootstrap) --}}
                    <div class="col-lg-4 col-md-6">
                        {{-- Menggunakan komponen Card dari Bootstrap --}}
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ Storage::url($item->image) }}" 
                                alt="{{ $item->name }}" 
                                class="card-img-top" 
                                style="aspect-ratio: 1 / 1; object-fit: cover;">
                            
                            <div class="card-body text-center d-flex flex-column">
                                <h5 class="card-title fw-semibold">{{ $item->name }}</h5>
                                <p class="card-text text-muted small flex-grow-1">{{ Str::limit($item->description, 50) }}</p>
                                <p class="card-text fs-5 fw-bold mt-2" style="color: #FF6B35;">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted py-5">Menu belum tersedia.</p>
                    </div>
                @endforelse
                
            </div>

            <div class="text-center mt-4">
            <a href="{{ route('menu.page') }}" class="btn text-white" style="background-color: #FF6B35; border-color: #FF6B35;">Lihat Semua Menu</a>
            </div>
        </div>
    </section>

    <section class="py-5" id="gallery-preview" data-aos="fade-up">
        <div class="container">
            <div class="menu-header text-center">
                <h2>Galeri Kami</h2>
            </div>
            
            {{-- Grid Container (Bootstrap) --}}
            <div class="row g-4 mt-4">

                @forelse ($galleryItems as $item)
                    {{-- Grid Item (Kolom Bootstrap) --}}
                    <div class="col-lg-4 col-md-6">
                        <img src="{{ Storage::url($item->image) }}" 
                            alt="{{ $item->title ?? 'Foto Galeri' }}" 
                            class="img-fluid rounded shadow-sm" 
                            style="aspect-ratio: 1 / 1; object-fit: cover;">
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">
                            Tidak ada foto di galeri saat ini.
                        </p>
                    </div>
                @endforelse

            </div>

            <div class="text-center mt-4">
                <a href="{{ route('gallery.page') }}" class="btn text-white" style="background-color: #FF6B35; border-color: #FF6B35;">Lihat Semua Galeri</a>
            </div>
        </div>
    </section>
@endsection