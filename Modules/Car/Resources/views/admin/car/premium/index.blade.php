@extends('themes.limitless.layouts.default')

@section('title', 'Special Cars')

@section('load')
@endsection

@section('pageheader')
    @include('car::admin.car.includes.pageheader')
@endsection

@section('content')

<div class="card">
    @if (session('status'))
        <div id="timer" class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="table-responsive" id="accordion-control">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Visibility</th>
                    <th>Author</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            @foreach ($contents as $group => $groupContents)
                <tr>
                    <th colspan="7" class="table-active">
                        <a data-toggle="collapse" class="text-default text-capitalize" href="#accordion-control-{{ $group }}">{{ $group }} ({{$groupContents->count()}})</a>
                    </th>
                </tr>
                <tbody id="accordion-control-{{ $group }}" class="collapse {{ $group == \App\Content::STATUS_PUBLISHED ? 'show' : '' }}" data-parent="#accordion-control">
                    @foreach($groupContents as $content)
                        <tr>
                            <td>{{$content->id}}</td>
                            <td>{{$content->title}}</td>
                            <td>
                                <a href="{{url($content->slug)}}" target="_blank">{{url($content->slug)}}</a>
                            </td>
                            <td>
                                <span class="badge badge-{{ $content->visibilityClass() }}">{{$content->visibility}}</span>
                            </td>
                            <td>
                                @include('themes.limitless.includes.user-media', ['user' => $content->author])
                            </td>
                            <td class="text-center">
                                @if ($content->metaValue('publishVerified') != "1")
                                <a class="btn btn-success color-white" href="#modal_verify" data-toggle="modal" onclick="verify_content({{ $content->id }})">Confirm</a>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="#" data-toggle="dropdown">
                                    <i class="icon-menu9 text-secondary"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('admin.modules.car.show', ['id' => $content->id]) }}">View</a>
                                    <a class="dropdown-item" href="{{ route('admin.modules.car.edit', ['id' => $content->id]) }}">Edit</a>
                                    <a class="dropdown-item" href="#modal_theme_danger" data-toggle="modal" onclick="delete_content({{ $content->id }})">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @endforeach
        </table>
    </div>
</div>

<!-- Danger modal -->
<div id="modal_theme_danger" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Delete?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete this content?</p>
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
<div id="modal_verify" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title">Confirm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to confirm this best premium request?</p>
            </div>

            <div class="modal-footer">
                <form method="POST" id="verify_form">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}

                    <input type="hidden" name="publishVerified" value="1" />
                    <input type="hidden" name="publishVerifiedBy" value="{{ Auth::user()->id }}" />

                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /default modal -->
@endsection

@section('script')
<script>
    window.delete_content = function(id) {
        $("#delete_form").attr('action', '/admin/cars/'+id+'?type={{ Request::get('type') }}');
    }
    window.verify_content = function(id) {
        $("#verify_form").attr('action', '/admin/modules/car/best_premium/'+id);
    }

    setTimeout(function(){ document.getElementById("timer").remove() }, 10000);
</script>
@endsection

