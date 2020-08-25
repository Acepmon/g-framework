@extends('themes.limitless.layouts.default')

@section('load')
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/tables/datatables/datatables.min.js') }}"></script>
@endsection

@section('pageheader')
<div class="page-header-content header-elements-inline">
    <div class="page-title d-flex">
        <h4><i class="icon-arrow-left52 ml-2"></i> <span class="font-weight-semibold">Users</span></h4>
    </div>

    <div class="header-elements d-none">
        <a href="{{ route('admin.users.create') }}" class="btn btn-labeled bg-blue heading-btn">Register New <i class="icon-add ml-2"></i></a>
    </div>
</div>

<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
    <div class="d-flex">
        <div class="breadcrumb">
            <a href="index.html" class="breadcrumb-item"><i class="icon-home2 ml-2"></i> Home</a>
            <span class="breadcrumb-item active">Users</span>
        </div>
    </div>

    <div class="header-elements d-none">
        <div class="breadcrumb justify-content-center">
            <a href="#" class="breadcrumb-elements-item"><i class="icon-comment-discussion mr-2"></i>Link</a>
            <div class="breadcrumb-elements-item dropdown p-0">
                <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="icon-gear mr-2"></i>Dropdown</a>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-84px, 40px, 0px);">
                    <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
                    <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
                    <a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page header -->
@endsection

@section('content')

<!-- Table -->

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Users datatable</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <table class="table table-condensed table-hover datatable-basic">
        <thead>
            <tr>
                <th style="width: 50px;">#</th>
                <th>User</th>
                <th style="width: 150px;">Groups</th>
                <th style="width: 150px;">Registered</th>
                <th style="width: 50px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @include('themes.limitless.includes.user-media', $user)
                </td>
                <td>
                    @if ($user->groups->count() > 1)
                        <a href="{{ route('admin.users.groups.index', [$user->id]) }}"><strong>{{ $user->groups->count() }}</strong> groups</a>
                    @else
                        @foreach ($user->groups as $group)
                            <a href="{{ route('admin.groups.show', [$group->id]) }}" class="label label-flat border-grey text-grey-600">
                                {{ $group->title }}
                            </a>
                        @endforeach
                    @endif
                </td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td>
                    <a href="#" data-toggle="dropdown">
                        <i class="icon-menu9 text-secondary"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('admin.modules.payment.transactions.create', ['user' => $user]) }}"><i class="icon-add"></i> Add Bonus</a>
                        <a class="dropdown-item" href="{{ route('admin.users.show', ['id' => $user->id]) }}"><i class="icon-eye"></i> View</a>
                        <a class="dropdown-item" href="{{ route('admin.users.edit', ['id' => $user->id]) }}"><i class="icon-pencil"></i> Edit</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_theme_danger" onclick="choose_user({{ $user->id }})"><i class="icon-trash"></i> Delete</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
                <p>Are you sure you want to delete this user?</p>
            </div>

            <div class="modal-footer">
                <form method="post" id="delete_form" action="/admin/users/0">
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
    window.choose_user = function(id) {
        $("#delete_form").attr('action', '/admin/users/'+id+'/');
    }
</script>
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
