@extends('layouts.app')

@section('navbar_home')
    @guest
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ url('/home') }}">Home</a>
        </li>

        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        @if ($user->customClaims['admin'] == false)
            <li class="nav-item">
                <a class="nav-link text-dark" href="/home/iamadmin">Become Seller</a>
            </li>
        @endif

        @if ($user->customClaims['admin'])
            <li class="nav-item">
                <a class="nav-link text-dark" href="/home/cars">{{ __('Seller Menu') }}</a>
            </li>
        @endif


        <li class="nav-item">
            <a class="nav-link text-dark" href="/home/profile">{{ __('Profile') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('logout') }}"
                onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>

    @endguest
@endsection

<style>
    .card-2 {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card-2:hover {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
    }
</style>

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-warning mb-2">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('search') }}" method="GET" class="mb-4"
                    style="display: flex; justify-content: center; align-items: center; text-align: center;">
                    <div class="join">

                        <div>
                            <input type="text" name="query" class="input input-bordered join-item bg-white rounded-md"
                                placeholder="Search" />
                        </div>

                        <select name="filter" class="select select-bordered join-item bg-white rounded-md">
                            <option disabled selected>Filter</option>
                            <option value="Bekas">USED</option>
                            <option value="Baru">NEW</option>
                        </select>

                        <div class="indicator">
                            <button class="btn btn-outline-info" type="submit">Search</button>
                        </div>

                    </div>
                </form>

                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('admin_assets/img/carousel1.jpg') }}"
                                alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('admin_assets/img/carousel2.jpg') }}"
                                alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('admin_assets/img/carousel3.jpg') }}"
                                alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="card-1 mt-4">
                    <div class="card-header">
                        <h4 class="text-lg font-semibold" style="margin-left: 3rem; margin-right: 3rem;">Cars List
                            @guest
                                <p class="float-end">Hello, Guest</p>
                            @else
                                <p class="float-end">Hello, {{ $user->displayName }}</p>
                            @endguest
                        </h4>
                    </div>
                </div>

            </div>
        </div>

        <!-- Cards Section -->
        <div class="row mt-4">
            @forelse($pagedPaginator->items() as $key => $item)
                <div class="col-md-4 mb-4">
                    <div class="card-2 bg-white shadow-lg rounded-lg overflow-hidden">
                        <figure>
                            <img src="{{ $item['image'] }}" alt="car!" class="object-cover w-full h-56">
                        </figure>
                        <div class="card-body">
                            <h2 class="text-xl font-semibold">{{ ucwords($item['merk']) }} {{ $item['model'] }}
                                ({{ $item['tahun_pembuatan'] }})
                                @if ($item['kondisi'] == 'Baru')
                                    <span class="badge badge-pill badge-danger">NEW</span>
                                @else
                                    <span class="badge badge-pill badge-info">USED</span>
                                @endif
                            </h2>
                            <p class="text-sm text-black">Price : Rp. {{ $item['harga'] }}</p>
                            <div class="flex justify-end mt-1">
                                <a href="{{ url('/home/product_details/' . $key) }}"
                                    class="btn btn-sm btn-ghost">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <p class="text-center">No Record Found</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col-md-12 d-flex justify-content-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">

                        {{-- Previous Page Link --}}
                        @if ($pagedPaginator->onFirstPage())
                            <li class="page-item disabled">
                                <button class="page-link bg-dark" aria-disabled="true">&laquo;</button>
                            </li>
                        @else
                            <li class="page-item">
                                <button class="page-link bg-dark text-light"
                                    onclick="window.location='{{ $pagedPaginator->previousPageUrl() }}'">&laquo;</button>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($pagedPaginator->getUrlRange(1, $pagedPaginator->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $pagedPaginator->currentPage() ? 'active' : '' }}">
                                <button class="page-link bg-dark text-light"
                                    onclick="window.location='{{ $url }}'">{{ $page }}</button>
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($pagedPaginator->hasMorePages())
                            <li class="page-item">
                                <button class="page-link bg-dark text-light"
                                    onclick="window.location='{{ $pagedPaginator->nextPageUrl() }}'">&raquo;</button>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <button class="page-link bg-dark" aria-disabled="true">&raquo;</button>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>

    </div>
@endsection
