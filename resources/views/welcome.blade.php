<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .navbar-custom {
            background-color: #006316;
        }
        .banner {
            background-image: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 400px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .banner-text {
            color: white;
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="{{ route('welcome') }}">Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('welcome') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('peminjaman') }}">Info Peminjaman Buku</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Pencarian" aria-label="Search">
                </form>
                <ul class="navbar-nav">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ url('/dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link text-white btn btn-link">Logout</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <div class="banner">
            <div class="banner-text">SELAMAT MEMBACA</div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img style="max-height: 450px" src="{{ $book->cover ? Storage::url($book->cover) : 'https://via.placeholder.com/200x300?text=No+Image' }}" class="card-img-top" alt="{{ $book->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <a href="{{ route('book.detail', $book->id) }}" class="btn btn-success">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
