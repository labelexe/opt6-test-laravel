@extends('layouts.dashboard.app')

@section('page_title')
{{ $page_title ? $page_title : '' }} - {{ $data['staff']['item']['name'] }}
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
            <a href="{{route('staff.update_form', $data['staff']['item']['id'] )}}" class="btn btn-primary" style="margin-right: 14px;">Ред.</a>
        </div>
        <div class="btn_action_item">
            <a href="{{route('staff.delete', $data['staff']['item']['id'] )}}" class="btn btn-danger">Удалить</a>
        </div>
    </div>
</div>

<main class="main">

    <div class="staff">
        <div class="staff_wrapper">
            {{-- staff Info --}}
            <div class="staff_title mb-5">
                <h4>{{ $data['staff']['item']['name'] }}</h4>
            </div>
            <div class="staff_email mb-4">
                {{ $data['staff']['item']['email'] }}
            </div>
            <div class="staff_phone mb-3">
                {{ $data['staff']['item']['phone'] }}
            </div>

            {{-- staff Staff --}}
            @isset($data['staff']['item']['company'])
            <div class="staff_company mb-3">
                <div class="staff_company_wrapper">
                    <div class="staff_company_heading">
                        <div class="staff_company_heading_content">
                            <div class="staff_company_heading_content_title mb-2">
                                Компания:
                            </div>
                        </div>
                    </div>
                    {{-- Staff --}}
                    <div class="staff_company_list">
                        {{-- Check Staff --}}

                        <div class="company_staff_list_item" style="margin-bottom: 10px; background: #f1f1f1; padding: 14px; border-radius: 6px;">
                            <a href="{{route('company.show', $data['staff']['item']['company']['id'])}}" style=" text-decoration: none;">{{$data['staff']['item']['company']['name']}}</a>
                        </div>

                    </div>
                </div>
            </div>
            @endisset

        </div>

    </div>

    {{-- {{ $data['staff']['item'] }} --}}
</main>
@endsection
