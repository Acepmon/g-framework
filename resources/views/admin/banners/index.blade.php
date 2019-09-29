@extends('themes.limitless.layouts.default')

@section('title', 'All Banners')

@section('load-before')

@endsection

@section('load')
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/tables/datatables/datatables.min.js') }}"></script>
@endsection

@section('pageheader')
    @include('admin.banners.includes.pageheader', , ['breadcrumb' => 'banners_index'])
@endsection

@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Location Banners Datatable</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    @if (isset($location))
        <div class="card-body">
            <p><strong>Showing banners for location</strong>: {{ $location->title }}</p>
        </div>
    @endif

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
                <th>Status</th>
                <th>Banner</th>
                <th>Link</th>
                <th>Location</th>
                <th>Schedule</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $index => $banner)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <a href="{{ route('admin.banners.show', $banner->id) }}">
                            {{ $banner->title }}
                        </a>
                    </td>
                    <td>
                        @if ($banner->status == \App\Banner::STATUS_ACTIVE)
                            <span class="text-success">{{ $banner->status }}</span>
                        @else
                            <span class="text-muted">{{ $banner->status }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($banner->banner)
                            <a href="{{ $banner->banner }}" target="_blank"><span class="icon-image2"></span></a>
                        @endif
                    </td>
                    <td>
                        @if ($banner->link)
                            <a href="{{ $banner->link }}" target="_blank"><span class="icon-link"></span></a>
                        @endif
                    </td>
                    <td>
                        @if ($banner->location_id)
                            <a href="{{ route('admin.banners.locations.show', $banner->location_id) }}">{{ $banner->location->title }}</a>
                        @endif
                    </td>
                    <td>
                        {{ $banner->starts_at }} <br>
                        {{ $banner->ends_at }}
                    </td>
                    <td>
                        <a href="#" data-toggle="dropdown">
                            <i class="icon-menu9 text-secondary"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('admin.banners.show', ['id' => $banner->id]) }}"><i class="icon-eye"></i> View</a>
                            <a class="dropdown-item" href="{{ route('admin.banners.edit', ['id' => $banner->id]) }}"><i class="icon-pencil"></i> Edit</a>
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

