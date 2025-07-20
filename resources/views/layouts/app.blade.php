<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title', 'Restorun')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    </head>
    <body>

    <header id="header" class="header fixed-top d-flex align-items-center">
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-white shadow">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
    <img src="{{ asset('images/logo.png') }}" alt="Kang Naryo Logo" style="height: 50px;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            {{-- Warna tulisan diubah menjadi hitam --}}
                            <a class="nav-link" href="{{ route('home') }}" style="color: black !important;">Home</a>
                        </li>
                        {{-- Link ke section di halaman home --}}
                        {{-- <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#about">Tentang Kita</a></li> --}}
                        {{-- Link ke halaman baru --}}
                        <li class="nav-item">
                             {{-- Warna tulisan diubah menjadi hitam --}}
                            <a class="nav-link" href="{{ route('menu.page')  }}" style="color: black !important;">Menu</a>
                        </li>
                        <li class="nav-item">
                             {{-- Warna tulisan diubah menjadi hitam --}}
                            <a class="nav-link" href="{{ route('gallery.page') }}" style="color: black !important;">Galeri</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>
    </body>
</html>