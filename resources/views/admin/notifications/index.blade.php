@extends('themes.limitless.layouts.default')

@section('title', 'Notifications')

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
        <h5 class="card-title">All Notification Events</h5>

        <div class="header-elements">
            <a href="{{ route('admin.notifications.create') }}" class="btn btn-primary btn-sm"><span class="icon-plus3 position-left"></span> New Event</a>
        </div>
    </div>

    <table class="table datatable-basic">
        <colgroup>
            <col style="width:5%">
            <col style="width:20%">
            <col style="width:50%">
            <col style="width:10%">
            <col>
        </colgroup>
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Body</th>
                <th>Sent at</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notifications as $notification)
            <tr>
                <td>{{ $notification->id }}</td>
                <td>{{ $notification->title }}</td>
                <td>{{ $notification->metaValue('body') }}</td>
                <td>{{ $notification->created_at }}</td>
                <td width="250px">
                    <div class="btn-group">
                        <form action="{{ route('admin.notifications.show', ['id' => $notification->id]) }}" method="GET" style="float: left; margin-right: 5px">
                            <button type="submit" class="btn btn-light">View</button>
                        </form>
                        <form action="{{ route('admin.notifications.edit', ['id' => $notification->id]) }}" method="GET" style="float: left; margin-right: 5px">
                            <button type="submit" class="btn btn-light">Edit</button>
                        </form>
                        <button data-toggle="modal" data-target="#modal_theme_danger" class="btn btn-light" onclick="delete_notification({{ $notification->id }})">Delete</button>
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
                <p>Are you sure you want to delete this notification?</p>
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
@endsection

@section('script')
<script>
    window.delete_notification = function(id) {
        $("#delete_form").attr('action', '/admin/notifications/'+id);
    }

    setTimeout(function(){ document.getElementById("timer").remove() }, 10000);

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

