@extends('themes.limitless.layouts.default')

@section('title', 'User Groups List')

@section('load')
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/tables/datatables/datatables.min.js') }}"></script>
@endsection

@section('pageheader')
    @include('admin.users.includes.pageheader', ['breadcrumb' => 'groups_index'])
@endsection

@section('content')
<div class="d-md-flex align-items-md-start">
    @include('admin.users.includes.sidebar')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h6 class="card-title">User Groups</h6>
                            <div class="header-elements">
                                <a href="{{ route('admin.users.groups.create', ['id' => $user->id]) }}" class="text-white btn btn-primary btn-sm">Add To Group</a>
                            </div>
                        </div>

                        <table class="table table-condensed datatable-basic">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->groups as $index => $group)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $group->title }}</td>
                                    <td>{{ $group->description }}</td>
                                    <td>
                                        <a href="#" class="btn btn-link btn-xs">Detach</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
            <!-- /tab content -->

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function() {
        // Table setup
        // ------------------------------

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

