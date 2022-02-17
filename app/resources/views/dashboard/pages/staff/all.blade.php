@extends('layouts.dashboard.app')

@section('page_title', 'Все сотрудники')

@section('content')
<div class="heading_wrapper d-flex align-items-center justify-content-between">
    <div class="heading_content">
        <div class="content_title">
            <h5>{{ $page_title }}</h3>
        </div>
    </div>
    <div class="heading_action d-flex justify-content-between">
        <div class="btn_action_item">
            <a href="{{route('staff.create_form')}}" class="btn btn-info" style="margin-right: 14px;">Создать</a>
        </div>
    </div>
</div>

<table class="table table-bordered" id="staff-table">
    <thead>
        <tr>
            <th>Полное имя</th>
            <th>Компания</th>
            <th>E-mail</th>
            <th>Номер</th>
            <th> </th>
            {{-- <th>Created At</th>
            <th>Updated At</th> --}}
        </tr>
    </thead>
</table>
@endsection

{{-- Add Scripts --}}

@push('header_scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
@endpush


@push('footer_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<!-- Script -->
<script>
    $(function() {
        var show_company_route_url = '{!! route('company.show.table') !!}';
        var edit_route_url = '{!! route('staff.show.table') !!}';

        var comp_table = $('#staff-table').DataTable({
            processing: true, 
            serverSide: true, 
            ajax: '{!! route('staff.table_data.all') !!}', 
            columns: [{
                data: 'name', 
                name: 'name'
                },
                //Company
                {
                    //defaultContent: '<a class="btn btn-primary btn-edit" >Edit</a>',
                    data: "id",
                    //title: "-",
                    defaultContent: "-"
                    , render: function(d, t, r) {
                        //console.log(d, t, r);
                        if (r !== null) {
                            console.log(r);
                            let result =
                                `<a href="${show_company_route_url}/${r.company.id}">${r.company.name}</a>`;
                            //
                            return d ? result : null;
                        }

                    }
                , }
                , {
                    data: 'email'
                    , name: 'email'
                }
                , {
                    data: 'phone'
                    , name: 'phone'
                }
                , {
                    //defaultContent: '<a class="btn btn-primary btn-edit" >Edit</a>',
                    data: "id",
                    //title: "-",
                    defaultContent: "-"
                    , render: function(d, t, r) {
                        //console.log(d, t, r);
                        if (r !== null) {
                            console.log(r);
                            let result =
                                `<a class="btn btn-warning" href="${edit_route_url}/${r.id}">Просмотр</a>`;
                            //
                            return d ? result : null;
                        }

                    }
                , }
            ]
        });
    });

</script>
@endpush
