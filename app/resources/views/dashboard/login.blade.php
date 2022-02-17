@extends('layouts.auth.index')

@section('page_title', 'Авторизация')

@section('content')

    <div class="d-flex justify-content-center align-items-center h-100">
        <main class="form-signin">
            <form method="post" action="{{ route('login.authenticate') }}">
                {{-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
                <h1 class="h3 mb-3 fw-normal">Авторизация</h1>

                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput">Email-адрес</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword"
                        placeholder="Password">
                    <label for="floatingPassword">Пароль</label>
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Запомнить меня
                    </label>
                </div>

                {{ csrf_field() }}

                <button class="w-100 btn btn-lg btn-primary" type="submit">Авторизоваться</button>
                {{-- <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p> --}}
            </form>
        </main>

    </div>

@endsection
