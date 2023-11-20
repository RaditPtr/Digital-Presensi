<html>

<head>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>@yield('title')</title>
    @yield('header')

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        /* Show it is fixed to the top */
        body {
            min-height: 75rem;
            padding-top: 4.5rem;
            font-family: 'Inter';
            background-color: #98E4FF;
        }

        nav {
            background-color: #ccf1ff;
        }

        .container {
            margin-top: 20px;
        }

        .bootstrap-table {
            margin-top: 60px;
            width: 100%;
            margin-bottom: 1rem;
        }

        .bootstrap-table table {
            border-collapse: collapse;
        }

        .bootstrap-table table td,
        .bootstrap-table table th {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
        }



        .bootstrap-table table th {
            background-color: #f5f5f5;
        }

        .bootstrap-table table img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .bootstrap-table table .aksi {
            text-align: center;
        }

        .thead {
            background-color: #5B5B5B !important;
            color: white !important;
            font-weight: 50;
            text-align: center;
        }

        .btntambah {
            background-color: #6FF745;
            text-align: center;
            width: 150px !important;
            height: 35px !important;

        }

        .button {
            text-align: center;
            width: 100px;
            height: 30px;
            border-radius: 5px;

            color: white;
            font-size: 16px;
            cursor: pointer;
            font-weight: 800;
            transition: all 0.2s ease-in-out;
            border: 1px solid black;
            font-size: 14.5;
            color: black;
            border-radius: 10px;
        }

        .btnDetail {
            background-color: #7EE6B9;
        }

        .btnDetail:hover {
            background-color: #23a881;
        }

        .btnEdit {
            background-color: #EAED2B;
        }

        .btnEdit:hover {
            background-color: #c2c429;
        }

        .btnHapus {
            background-color: #DB3223;
        }

        .btnHapus:hover {
            background-color: #a62a1f;
        }

        .button:hover {
            color: black;
        }

        .button:active {
            background-color: #1f8e6b;
        }

        .listbtn {
            display: flex;
            justify-content: space-around;
        }

        .col-md-2 {
            padding-left: 3%;
            float: right;
        }

        .photo-container {
            display: flex;
            overflow: hidden;
            justify-content: center;
            align-items: center;

            width: 150px;
            height: 150px;
        }


        .dropdown-menu-left {
            right: 0;
            left: auto;
        }

        .content-header {
            font-weight: 1000 !important;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-md fw-semibold fixed-top text-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">GeoPresensi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        @if (Auth::check() && Auth::user()->role == 'tatausaha')
                        <a class="nav-link active" aria-current="page" href="/dashboard/tatausaha">Dashboard</a>
                        @elseif (Auth::check() && Auth::user()->role == 'walikelas')
                        <a class="nav-link active" aria-current="page" href="/dashboard/walikelas">Dashboard</a>
                        @elseif (Auth::check() && Auth::user()->role == 'gurupiket')
                        <a class="nav-link active" aria-current="page" href="/dashboard/gurupiket">Dashboard</a>
                        @elseif (Auth::check() && Auth::user()->role == 'gurubk')
                        <a class="nav-link active" aria-current="page" href="/dashboard/gurubk">Dashboard</a>
                        @elseif (Auth::check() && Auth::user()->role == 'siswa')
                        <a class="nav-link active" aria-current="page" href="/dashboard/siswa">Dashboard</a>
                        @elseif (Auth::check() && Auth::user()->role == 'pengurus')
                        <a class="nav-link active" aria-current="page" href="/dashboard/pengurus">Dashboard</a>
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('transaksi/surat') }}">List</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto d-flex flex-row gap-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="42" alt="" width="42" loading="lazy" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-left h-1" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item my-0" href="/dashboard/siswa/profil">Profil</a>
                            <hr>
                            <a href="{{ url('/logout') }}" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                </ul>

                <div class="d-flex">

                </div>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <div class="container">
        @include('layout.flash-message')
        @yield('content')
    </div>
</body>
<footer>
    @yield('footer')
</footer>

</html>