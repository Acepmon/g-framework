@extends('themes.limitless.layouts.default')

@section('load')
@endsection

@section('pageheader')
<div class="page-header-content header-elements-inline">
    <div class="page-title d-flex">
        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{ ucfirst(Request::get('taxonomy')) }}</span></h4>
    </div>

    <div class="header-elements">
        <a href="{{ route('admin.taxonomy.create', ['taxonomy' => Request::get('taxonomy')]) }}" class="btn btn-primary">Create New {{ ucfirst(Request::get('taxonomy')) }}</a>
    </div>
</div>

<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
    <div class="d-flex">
        <div class="breadcrumb">
            <a class="breadcrumb-item" href="index.html"><i class="icon-home2 mr-2"></i> Home</a>
            <span class="breadcrumb-item active">{{ ucfirst(Request::get('taxonomy')) }} List</span>
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

<div class="card">
    @if (session('status'))
        <div id="timer" class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($term_taxonomies as $term_taxonomy)
                <tr>
                    <td>{{$term_taxonomy->id}}</td>
                    <td>{{$term_taxonomy->term->name}}</td>
                    <td>{{$term_taxonomy->term->slug}}</td>
                    <td>{{$term_taxonomy->description}}</td>
                    <td>{{$term_taxonomy->count}}</td>
                    <td width="250px">
                        <div class="btn-group">
                            <form action="{{ route('admin.taxonomy.show', ['id' => $term_taxonomy->id]) }}" method="GET" style="float: left; margin-right: 5px">
                                <button type="submit" class="btn btn-light">View</button>
                            </form>
                            <form action="{{ route('admin.taxonomy.edit', ['id' => $term_taxonomy->id]) }}" method="GET" style="float: left; margin-right: 5px">
                                <button type="submit" class="btn btn-light">Edit</button>
                            </form>
                            <button data-toggle="modal" data-target="#modal_theme_danger" class="btn btn-light" onclick="delete_term_taxonomy({{ $term_taxonomy->id }})">Delete</button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
                <p>Are you sure you want to delete this {{ Session::get('type') }}?</p>
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
    window.delete_term_taxonomy = function(id) {
        $("#delete_form").attr('action', '/admin/taxonomy/'+id);
    }

    setTimeout(function(){ document.getElementById("timer").remove() }, 10000);
</script>
@endsection

