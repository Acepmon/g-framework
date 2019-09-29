@extends('themes.limitless.layouts.default')

@section('title', $exists ? $filename : 'Error Logs')

@section('load')
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/tables/datatables/datatables.min.js') }}"></script>
@endsection

@section('pageheader')
    @include('admin.logs.includes.pageheader', ['breadcrumb' => 'logs_index'])
@endsection

@section('content')
<div class="sidebar-detached">
    <div class="sidebar sidebar-default">
        <div class="sidebar-content">
            <div class="sidebar-category">
                <div class="category-title">
                    <span>Laravel Logs</span>
                    <ul class="icons-list">
                        <li><a href="#" data-action="collapse"></a></li>
                    </ul>
                </div>

                <div class="category-content no-padding">
                    <ul class="navigation navigation-alt navigation-accordion">
                        @foreach ($logs as $index => $log)
                        <li class="{{ $filename == $log['filename'] ? 'active' : '' }}">
                            <a href="{{ route('admin.logs.index', ['file' => $log['filename']]) }}">
                                {{ $log['filename'] }}
                                @if ($log['is_today']) <span class="label label-primary">today</span> @endif
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-detached">
    <div class="content-detached">
        @if ($exists)
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h4 class="card-title">
                        {{ $filename }}
                    </h4>

                    <div class="header-elements">
                        <button type="button" data-toggle="modal" data-target="#modal_theme_danger" onclick="choose_log('{{ $filename }}')" class="btn btn-light"><span class="icon-trash position-left"></span> Delete File</button>
                    </div>
                </div>

                <div class="card-body">
                    <pre class="language-log"><code>{!! $file_contents !!}</code></pre>
                </div>
            </div>
        @else
            <div class="alert alert-danger">
                <p><strong>Error!</strong> Log file doesn't exist.</p>
            </div>
        @endif
    </div>
</div>

<div id="modal_theme_danger" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Delete?</h6>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete this log file?</p>
            </div>

            <div class="modal-footer">
                <form method="post" id="delete_form" action="{{ route('admin.logs.delete', ['log' => $filename]) }}">
                    @csrf
                    @method('DELETE')

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
window.choose_log = function(filename) {
    $("#delete_form").attr('action', '/admin/logs/'+filename+'/');
}
$(document).ready(function () {
    $("body").addClass('has-detached-left');
});
</script>
@endsection

