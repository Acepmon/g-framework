@extends('themes.limitless.layouts.default')

@section('title', 'Index')

@section('load-before')

@endsection

@section('load')
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/tables/datatables/datatables.min.js') }}"></script>
@endsection

@section('pageheader')
    @include('admin.banners.includes.pageheader', ['breadcrumb' => 'banners_locations_index'])
@endsection

@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Banners Datatable</h5>
        <div class="header-elements">
            <a href="{{ route('admin.banners.locations.create') }}" class="btn btn-light"><span class="icon-plus3 mr-2"></span> New Location</a>
        </div>
    </div>

    @if (session('status'))
        <div class="card-body">
            <div class="alert alert-success">
                {!! session('status') !!}
            </div>
        </div>
    @endif

    <table class="table table-condensed table-hover datatable-basic">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Banners</th>
                <th>Size</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $index => $location)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $location->title }}</td>
                    <td><a href="{{ route('admin.banners.index') }}?location_id={{ $location->id }}">{{ count($location->banners) }}</a></td>
                    <td>{{ $location->width . 'x' . $location->height }}</td>
                    <td>{{ $location->type }}</td>
                    <td>
                        <a href="#" data-toggle="dropdown">
                            <i class="icon-menu9 text-secondary"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('admin.banners.locations.show', ['id' => $location->id]) }}"><i class="icon-eye"></i> View</a>
                            <a class="dropdown-item" href="{{ route('admin.banners.locations.edit', ['id' => $location->id]) }}"><i class="icon-pencil"></i> Edit</a>
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

