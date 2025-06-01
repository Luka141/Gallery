<!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gallery</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Gallery Filter CSS -->
    <link href="{{ asset('css/gallery-filter.css') }}" rel="stylesheet">
    
    @yield('head')
    @yield('styles')
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="/"> Main</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="galleryFilterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                 Gallery Filter
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><button class="dropdown-item filter-nav-btn active" data-filter="all"> All</button></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><button class="dropdown-item filter-nav-btn" data-filter="image"> Images</button></li>
                                <li><button class="dropdown-item filter-nav-btn" data-filter="video"> Videos</button></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Gallery Filter JS -->
    <script src="{{ asset('js/gallery-filter.js') }}"></script>
    
    @yield('scripts')
 
</body>
</html>