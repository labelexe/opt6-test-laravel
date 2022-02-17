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
    <div class="heading_action d-flex justify-content-between">
        <div class="btn_action_item">
            <a href="{{route('company.create_form')}}" class="btn btn-info" style="margin-right: 14px;">Создать</a>
        </div>
    </div>
</div>

<table class="table table-bordered" id="company-table">
    <thead>
        <tr>
            <th> - </th>
            <th>Название компании</th>
            <th>E-mail</th>
            <th>Адрес</th>
            <th> </th>
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
        var edit_route_url = '{!! route('company.show.table') !!}';
        var comp_table = $('#company-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('company.table_data.all') !!}',


            columns: [{
                    title: "Логотип",
                    data: "logo_src",
                    defaultContent: "-",
                    render: function(d, t, r) {
                        //console.log(d, t, r);

                        if (r !== null) {
                            let result =
                                `<img src="${r.logo_src}" alt="${r.name}" class="img-dt-logo">`;
                            //
                            return d ? result : null;
                        }

                    },
                    className: "logo_src"
                }, {
                    data: 'name',
                    name: 'name'
                }, {
                    data: 'email',
                    name: 'email'
                }, {
                    data: 'address',
                    name: 'address'
                },

                {
                    //defaultContent: '<a class="btn btn-primary btn-edit" >Edit</a>',
                    data: "id",
                    title: "Управление",
                    defaultContent: "-",
                    render: function(d, t, r) {
                        //console.log(d, t, r);
                        if (r !== null) {
                            console.log(r);
                            let result =
                                `<a class="btn btn-warning" href="${edit_route_url}/${r.id}">Просмотр</a>`;
                            //
                            return d ? result : null;
                        }

                    },
                }
                /*{
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                } */
            ]
        });
        //Event Click row


        /* var _onRowClick = function(evt) {
            //get textContent of the TD
            console.log('TD cell textContent : ', this.textContent)
            //get the value of the TD using the API
            console.log('value by API : ', comp_table.cell({
                column: this.cellIndex
            }).data());
        }

        comp_table.on("#company-table click", "tbody tr", _onRowClick); */


    });
</script>
@endpush