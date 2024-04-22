@extends('layouts.app')

@section('navbar_home')
    @if (Route::has('login'))
        @auth
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ url('/home') }}">Home</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ url('/home') }}">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('login') }}">Login</a>
            </li>

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('register') }}">Register</a>
                </li>
            @endif
        @endauth
    @else
    @endif
@endsection

@section('content')
    <div class="hero bg-cover bg-center flex items-center justify-center text-white">
        <div class="text">
            <h4 class="text-3xl font-semibold mb-2">Powerful, Fun and</h4>
            <h1 class="text-5xl font-bold mb-4">Lets to <br> <span class="text-blue-500">Drive</span></h1>
            <p class="text-lg mb-6">Experience Excellence on Every Mile</p>
            <a href="{{ url('/home') }}" class="btn bg-blue-500 hover:bg-blue-600 text-white">Home</a>
        </div>
    </div>

    <div class="container mx-auto my-8">
        <div class="card">
            <div class="card-header">{{ __('Welcome') }}</div>

            <div class="card-body">
                <div class="container text-center mt-5">
                    <h1 class="text-5xl font-bold mb-5">Welcome to <a href="https://barocars.up.railway.app/"
                            class="text-primary hover:text-secondary">BaroCars Web</a>
                        <span>&#127881;</span>
                    </h1>
                    <div>
                        <img src="{{ asset('admin_assets/img/image1.jpg') }}">
                    </div>
                    <p class="text-lg leading-relaxed my-5">We've seamlessly integrated Firebase into our platform,
                        enabling powerful
                        features like <span class="text-danger">Realtime Database</span>, <span
                            class="text-danger">Authentication</span>, <span class="text-danger">Email
                            Verification</span>, and an <span class="text-danger">Admin Panel</span>. With Firebase,
                        we ensure real-time data updates, secure user authentication, and efficient administration.
                        Lets go Explore!</p>
                    <p class="text-lg">Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP
                        v{{ PHP_VERSION }})</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        let heroBg = document.querySelector('.hero');
        let bgLightUrl = "{{ asset('admin_assets/img/bg-light.jpg') }}";
        let bgUrl = "{{ asset('admin_assets/img/bg.jpg') }}";

        setInterval(() => {
            heroBg.style.backgroundImage = "url('" + bgLightUrl + "')";

            setTimeout(() => {
                heroBg.style.backgroundImage = "url('" + bgUrl + "')";
            }, 1000);
        }, 2200);
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <style>
        /* font */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
        }

        .hero {
            width: 100%;
            height: 100vh;
            background-position: center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero .text {
            width: 90%;
            margin: auto;
        }

        .hero .text h4 {
            font-size: 40px;
            color: #fff;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .hero .text h1 {
            color: #fff;
            font-size: 65px;
            text-transform: uppercase;
            line-height: 1;
            margin-bottom: 30px;
        }

        .hero .text h1 span {
            color: #dd0707;
            font-size: 80px;
            font-weight: bold;
        }

        .hero .text p {
            color: #fff;
            margin-bottom: 30px;
        }

        .hero .text .btn {
            padding: 10px 30px;
            background-color: #dd0707;
            text-transform: uppercase;
            color: #fff;
            font-weight: bold;
            border-radius: 30px;
            border: 2px solid #dd0707;
            transition: 0.3s;
        }

        .hero .text .btn:hover {
            background-color: transparent;
        }
    </style>
@endsection
