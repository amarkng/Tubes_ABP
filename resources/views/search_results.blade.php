@extends('layouts.app')

@section('navbar_home')
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item">
            <a class="nav-link text-dark" href="/home/profile">{{ __('Profile') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ url('/home') }}">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-dark active" href="{{ route('logout') }}"
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

@section('content')
    <div class="container">
        <h1>Search Results for "{{ $query }}"</h1>
        <div><br></div>
        <div class="row">
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
                                    <div class="badge badge-secondary">NEW</div>
                                @else
                                    <div class="badge badge-accent">USED</div>
                                @endif
                            </h2>
                            <p class="text-sm text-black">Harga : Rp. {{ $item['harga'] }}</p>
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
        <!-- pagination nih -->
        <div class="join col-md-12 justify-center">
            {{-- Previous Page Link --}}
            @if ($pagedPaginator->onFirstPage())
                <button class="join-item btn">&laquo;</button>
            @else
                <button class="join-item btn"
                    onclick="window.location='{{ $pagedPaginator->previousPageUrl() }}'">&laquo;</button>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($pagedPaginator->getUrlRange(1, $pagedPaginator->lastPage()) as $page => $url)
                @if ($page == $pagedPaginator->currentPage())
                    <button class="join-item btn btn-active">{{ $page }}</button>
                @else
                    <button class="join-item btn"
                        onclick="window.location='{{ $url }}'">{{ $page }}</button>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($pagedPaginator->hasMorePages())
                <button class="join-item btn"
                    onclick="window.location='{{ $pagedPaginator->nextPageUrl() }}'">&raquo;</button>
            @else
                <button class="join-item btn">&raquo;</button>
            @endif
        </div>
    </div>
@endsection
