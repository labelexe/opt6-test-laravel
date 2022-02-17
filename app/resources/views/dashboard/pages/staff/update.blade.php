@extends('layouts.dashboard.app')

@section('page_title')
{{ $page_title ? $page_title : '' }} - {{ $data['staff']['item']['name'] }}
@endsection

@section('content')
<div class="heading_wrapper d-flex align-items-center justify-content-between">
    <div class="heading_content">
        <div class="content_title">
            <h5>{{ $page_title }} - {{ $data['staff']['item']['name'] }}</h3>
        </div>
    </div>

</div>



<main class="main">

    <div class="staff">
        <div class="staff_wrapper">

            @if ($errors->any())
            <div class="staff_error">

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
            <div class="staff_form">
                <form method="POST" action="{{route('staff.update', $data['staff']['item']['id'])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="staff_form_wrapper">
                        <div class="staff_form_list">
                            <div class="staff_from_item mb-3">
                                <div class="form-group">
                                    <label for="namestaff" class="m-2">Полное имя сотрудника</label>
                                    <input type="text" id="namestaff" name="name" class="form-control" placeholder="Введите полное имя сотрудника" value="{{ $data['staff']['item']['name'] ?  $data['staff']['item']['name'] :'' }}">

                                </div>
                            </div>

                            <div class="staff_from_item mb-3">
                                <div class="form-group">
                                    <label for="emailstaff" class="m-2">Email сотрудника</label>
                                    <input type="email" id="emailstaff" name="email" class="form-control" placeholder="Введите email-сотрудника" value="{{ $data['staff']['item']['email'] ? $data['staff']['item']['email'] : '' }}">
                                </div>
                            </div>

                            <div class="staff_from_item mb-3">
                                <div class="form-group">
                                    <label for="telephonestaff" class="m-2">Номер телефона сотрудника</label>
                                    <input type="text" id="telephonestaff" name="phone" class="form-control" placeholder="Введите номер телефона сотрудника" value="{{ $data['staff']['item']['phone'] ? $data['staff']['item']['phone'] : '' }}">
                                </div>
                            </div>

                            @if($data['company']['items'] && $data['company']['items']['all'])
                            <div class="staff_from_item mb-3">
                                <div class="form-group">
                                    <label for="compnay_id_staff" class="m-2">Компания сотрудника</label>
                                    <select name="company_id" id="compnay_id_staff" class="form-control">
                                        @foreach($data['company']['items']['all'] as $option_company)
                                        {{-- <option value="{{$option_company->id}}" {{(old($data['staff']['item']['company_id']) ==  $option_company->id) ? 'selected':''}}>{{$option_company->name}}</option> --}}
                                        {{-- --}}
                                        {{-- <option value="{{ $option_company->id }}">{{ $option_company->name }}</option> --}}


                                        <option value="{{ $option_company->id }}" @if($data['staff']['item'] && $data['staff']['item']->company->id && $data['staff']['item']->company->id == $option_company['id'])
                                            selected @endif >
                                            {{ $option_company->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="staff_from_item">
                                {{-- <div class="form-group"> --}}
                                <button type="submit" class="btn btn-warning">Обновить</button>
                                {{-- </div> --}}
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- {{ $data['staff']['item'] }} --}}
</main>
@endsection

{{-- Add Scripts --}}

@push('header_scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- yandex maps --}}

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=2b223cd4-aef9-45c6-bb16-cb5982a853f6" type="text/javascript"></script>
@endpush
