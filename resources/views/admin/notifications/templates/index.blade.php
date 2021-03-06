@extends('themes.limitless.layouts.default')

@section('title', 'Templates')

@section('load')
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/forms/selects/select2.min.js') }}"></script>
@endsection

@section('pageheader')
    @include('admin.notifications.includes.pageheader')
@endsection

@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">All Notification Templates</h5>

        <div class="header-elements">
            <a href="{{ route('admin.notifications.templates.create') }}" class="btn btn-primary btn-sm"><span class="icon-plus3 position-left"></span> New Template</a>
        </div>
    </div>

    @if (session('status'))
        <div class="card-body">
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        </div>
    @endif

    <table class="table datatable-basic">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Type</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($templates as $key => $template)
            <tr>
                <td>{{ $key+1 }}</td>
                <td><a href="{{ route('admin.notifications.templates.show', ['id' => $template->id]) }}">{{ $template->title }}</a></td>
                <td>{{ $template->type }}</td>
                <td class="text-center">
                    <div class="dropdown">
                        <a href="#" data-toggle="dropdown">
                            <i class="icon-menu9 text-secondary"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('admin.notifications.templates.show', ['id' => $template->id]) }}"><i class="icon-eye"></i> View</a>
                            <a href="{{ route('admin.notifications.templates.edit', ['id' => $template->id]) }}"><i class="icon-pencil"></i> Edit</a>
                            <a href="#" data-toggle="modal" data-target="#modal_theme_danger" onclick="showDeleteModal({{ $template->id }})"><i class="icon-trash"></i> Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
                width: '100px',
                targets: [ 5 ]
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

