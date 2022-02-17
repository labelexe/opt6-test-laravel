<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/auth.css">

    <!-- Custom styles for this template -->
    <link href="/assets/css/offcanvas.css" rel="stylesheet">

    <!-- App scripts -->
    @stack('header_scripts')
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Main navigation">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard.index') }}">УП</a>
            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('company.all') }}">Компании</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('staff.all') }}">Сотрудники</a>
                    </li>
                </ul>

                <div class="app_menu d-flex text-white">

                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropUserMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-none d-lg-inline"> {{ auth()->user()->name ? auth()->user()->name : '' }}</span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropUserMenu">
                            {{-- <li><a class="dropdown-item" href="#">Профиль</a></li> --}}
                            <li><a class="dropdown-item" href="{{route('login.logout')}}">Выход</a></li>
                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </nav>

    <div class="container-wrapper p-3 my-3">
        @yield('content')
    </div>

    <!-- App scripts -->
    @stack('footer_scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>
