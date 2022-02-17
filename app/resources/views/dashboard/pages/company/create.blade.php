@extends('layouts.dashboard.app')

@section('page_title')
{{ $page_title ? $page_title : '' }}
@endsection

@section('content')
<div class="heading_wrapper d-flex align-items-center justify-content-between">
    <div class="heading_content">
        <div class="content_title">
            <h5>{{ $page_title }}</h3>
        </div>
    </div>

</div>

<main class="main">
    <div class="company">
        <div class="company_wrapper">

            @if ($errors->any())
            <div class="company_error">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            {{-- --}}
            <div class="company_form">
                <form method="POST" action="{{route('company.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="company_form_wrapper">
                        <div class="company_form_list">
                            <div class="company_from_item mb-3">
                                <div class="form-group">
                                    <label for="fileLogoCompany" class="m-2">Логотип компании</label>
                                    <input type="file" id="fileLogoCompany" name="logo_image">
                                </div>
                            </div>

                            <div class="company_from_item mb-3">
                                <div class="form-group">
                                    <label for="nameCompany" class="m-2">Название компании</label>
                                    <input type="text" id="nameCompany" name="name" class="form-control" placeholder="Введите название-компании">

                                </div>
                            </div>

                            <div class="company_from_item mb-3">
                                <div class="form-group">
                                    <label for="emailCompany" class="m-2">Email компании</label>
                                    <input type="email" id="emailCompany" name="email" class="form-control" placeholder="Введите email-компании">
                                </div>
                            </div>

                            <div class="company_from_item mb-3">
                                <div class="form-group">
                                    <label for="addressCompany" class="m-2">Адрес компании</label>
                                    <input type="text" id="addressCompany" name="address" class="form-control" placeholder="Введите адрес-компании">
                                </div>
                            </div>

                            <div class="company_from_item">
                                {{-- <div class="form-group"> --}}
                                <button type="submit" class="btn btn-primary">Создать</button>
                                {{-- </div> --}}
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- {{ $data['company']['item'] }} --}}
</main>
@endsection

{{-- Add Scripts --}}

@push('header_scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- yandex maps --}}

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=2b223cd4-aef9-45c6-bb16-cb5982a853f6" type="text/javascript"></script>
@endpush
