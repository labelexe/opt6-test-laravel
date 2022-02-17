@extends('layouts.dashboard.app')

@section('page_title')
{{ $page_title ? $page_title : '' }} - {{ $data['company']['item']['name'] }}
@endsection

@section('content')
<div class="heading_wrapper d-flex align-items-center justify-content-between">
    <div class="heading_content">
        <div class="content_title">
            <h5>{{ $page_title }}</h3>
        </div>
    </div>
    <div class="heading_action d-flex justify-content-between">
        <div class="btn_action_item">
            <a href="{{route('company.update_form', $data['company']['item']['id'])}}" class="btn btn-primary" style="margin-right: 14px;">Ред.</a>
        </div>
        <div class="btn_action_item">
            <a href="{{route('company.delete', $data['company']['item']['id'])}}" class="btn btn-danger">Удалить</a>
        </div>
    </div>
</div>



<main class="main">

    <div class="company">
        <div class="company_wrapper">
            {{-- Company Info --}}
            <div class=" company_logo">
                <img src="{{ $data['company']['item']['logo_src'] }}" alt="{{ $data['company']['item']['name'] }}" class="img-show-logo">
            </div>
            <div class="company_title">
                <h4>{{ $data['company']['item']['name'] }}</h4>
            </div>
            <div class="company_email">
                {{ $data['company']['item']['email'] }}
            </div>

            {{-- Company Staff --}}
            @if($data['company']['item'] && $data['company']['item']['staff'] !== null &&count($data['company']['item']['staff']) > 0)
            <div class="company_staff" style="margin-bottom: 35px">
                <div class="company_staff_wrapper">
                    <div class="company_staff_heading">
                        <div class="company_staff_heading_content">
                            <div class="company_staff_heading_content_title" style="margin-bottom: 20px;">
                                Список сотрудников компании:
                            </div>
                        </div>
                    </div>
                    {{-- Staff --}}

                    <div class="company_staff_list">
                        {{-- Check Staff --}}
                        @foreach ($data['company']['item']['staff'] as $staff_item)
                        <div class="company_staff_list_item" style="margin-bottom: 10px; background: #f1f1f1; padding: 14px; border-radius: 6px;">
                            <a href="{{route('staff.show', $staff_item->id)}}" style=" text-decoration: none;">{{$staff_item->name ? $staff_item->name : ''}}</a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif


            <div class="company_address">
                {{ $data['company']['item']['address'] ? $data['company']['item']['address'] : '' }} / {{ $data['company']['item_ym_cords'] ? (string) implode(",",$data['company']['item_ym_cords']): ''}}
            </div>

            <div class="company_map">
                <div id="map" style="height: 450px"></div>
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

@push('footer_scripts')
<script>
    var company_item = @json($data['company']['item']);
    var address_cord = @json($data['company']['item_ym_cords']);

    ymaps.ready(init);

    function init() {

        if (company_item && address_cord) {
            // Создание карты.
            ymaps.ready(init);

            function init() {
                var showMyMaps = new ymaps.Map('map', {
                    center: address_cord
                    , zoom: 14.5
                });

                // Создадим метку.
                var map_placemark = new ymaps.Placemark(address_cord, {
                    iconContent: company_item.title ? company_item.title : '-'
                }, {
                    preset: 'islands#blueDotIcon'
                    , iconColor: '#ff0000',
                    // Отключаем кнопку закрытия балуна.
                    balloonCloseButton: false,
                    // Балун будем открывать и закрывать кликом по иконке метки.
                    hideIconOnBalloonOpen: true
                });

                showMyMaps.geoObjects.add(map_placemark);
            }
        }

    };

</script>
@endpush
