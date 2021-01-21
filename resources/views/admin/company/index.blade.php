@extends('themes.limitless.layouts.default')

@section('title', 'Company')

@section('load')
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/tables/datatables/datatables.min.js') }}"></script>
@endsection

@section('pageheader')
    @include('admin.company.includes.pageheader')
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12">
        @if (session('status'))
        <div class="card">
            <div class="card-body">
                    <div id="timer" class="alert alert-success">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="card">

            <table class="table table-condensed table-hover datatable-basic">
                <thead>
                    <tr>
                        <th style="width: 50px">#</th>
                        <th style="width: 150px;">Company name</th>
                        <th style="width: 150px;">Website</th>
                        <th>Retail phone</th>
                        <th style="width: 100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>{{$company->id}}</td>
                            <td>
                                <a href="{{ route('admin.company.show', ['id' => $company->id]) }}">
                                    {{$company->title}}
                                </a>
                            </td>
                            <td>{{$company->metaValue("website")}}</td>
                            <td>{{$company->metaValue("retailPhone")}}</td>
                            <td>
                                <a href="#" data-toggle="dropdown">
                                    <i class="icon-menu9 text-secondary"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('admin.company.show', ['id' => $company->id]) }}"><i class="icon-eye"></i> View</a>
                                    <a class="dropdown-item" href="{{ route('admin.company.edit', ['id' => $company->id]) }}"><i class="icon-pencil"></i> Edit</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_theme_danger" onclick="choose_group({{ $company->id }})"><i class="icon-trash"></i> Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>


<!-- Danger modal -->
<div id="modal_theme_danger" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Delete?</h6>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete this company?</p>
            </div>

            <div class="modal-footer">
                <form method="POST" id="delete_form">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}

                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /default modal -->
@endsection

@section('script')
<script>
    window.choose_group = function(id) {
        $("#delete_form").attr('action', '/admin/company/'+id);
    }

    setTimeout(function(){ document.getElementById("timer").remove() }, 10000);

    $(function() {
        // Setting datatable defaults
        $.extend( $.fn.dataTable.defaults, {
            autoWidth: false,
            columnDefs: [{
                orderable: false,
                width: '100px'
            }],
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
            },
            drawCallback: function () {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
            },
            preDrawCallback: function() {
                $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
            }
        });
        // Basic datatable
        $('.datatable-basic').DataTable();
    });
</script>
@endsection

