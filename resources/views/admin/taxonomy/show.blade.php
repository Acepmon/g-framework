@extends('admin.layouts.default')

@section('load')
@endsection

@section('pageheader')
<div class="page-header-content">
    <div class="page-title">
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">{{ ucfirst($term_taxonomy->taxonomy) }} Detail</span></h4>
    </div>

    <div class="heading-elements">
    </div>
</div>

<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ route('admin.taxonomy.index', ['taxonomy' => $term_taxonomy->taxonomy]) }}">{{ ucfirst($term_taxonomy->taxonomy) }} List</a></li>
        <li class="active">Detail</li>
    </ul>

    <ul class="breadcrumb-elements">
        <li><a href="#"><i class="icon-comment-discussion position-left"></i> Link</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-gear position-left"></i>
                Dropdown
                <span class="caret"></span>
            </a>

            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
            </ul>
        </li>
    </ul>
</div>
<!-- /page header -->
@endsection

@section('content')

<!-- Grid -->
<div class="row">
    <div class="col-md-7">

        <!-- Horizontal form -->
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label col-lg-2">Name</label>
                    <div class="col-lg-10">
                        <label class="control-label col-lg-2">{{$term_taxonomy->term->name}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">Slug</label>
                    <div class="col-lg-10">
                        <label class="control-label col-lg-2">{{$term_taxonomy->term->slug}}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2">Description</label>
                    <div class="col-lg-10">
                        <label class="control-label col-lg-2">{{ $term_taxonomy->description}}&nbsp;</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2">Parent</label>
                    <div class="col-lg-10">
                        <label class="control-label col-lg-2">{{$term_taxonomy->parent_id}}&nbsp;</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2">Count</label>
                    <div class="col-lg-10">
                        <label class="control-label col-lg-2">{{$term_taxonomy->count}}</label>
                    </div>
                </div>
                <div class="text-right" style="padding-bottom: 5px">
                    <a href="{{ route('admin.taxonomy.index', ['taxonomy' => $term_taxonomy->taxonomy]) }}" class="btn btn-default">Back</a>
                    <a href="{{ route('admin.taxonomy.edit', ['id' => $term_taxonomy->id]) }}" class="btn btn-default">Edit</a>
                </div>
            </div>
        </div>
        <!-- /horizotal form -->
    </div>

    <div class="col-sm-5">
        <div class="text-right" style="padding-bottom: 5px">
            <a href="{{ route('admin.taxonomy.metas.create', ['id' => $term_taxonomy->id, 'taxonomy_type' => $term_taxonomy->taxonomy ]) }}" class="btn btn-primary">Create {{ ucfirst($term_taxonomy->taxonomy) }} Metas</a>
        </div>
        <div class="panel panel-flat">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Key</th>
                            <th>Value</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($term_taxonomy->term->metas as $meta)
                        <tr>
                            <td>{{$meta->id}}</td>
                            <td>{{$meta->key}}</td>
                            <td>{{$meta->value}}</td>
                            <td width="250px">
                                <div class="btn-group">
                                    <form action="{{ route('admin.taxonomy.metas.edit', ['taxonomy' => $term_taxonomy->id, 'meta' => $meta->id, 'taxonomy_type' => $term_taxonomy->taxonomy]) }}" method="GET" style="float: left; margin-right: 5px">
                                        <button type="submit" class="btn btn-default">Edit</button>
                                    </form>
                                    <button data-toggle="modal" data-target="#modal_theme_danger" class="btn btn-default" onclick="delete_meta( {{$meta->id}} , {{$term_taxonomy->id}})">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /grid -->

<!-- Danger modal -->
<div id="modal_theme_danger" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Delete?</h6>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete this {{ $term_taxonomy->taxonomy }} meta?</p>
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
    window.delete_meta = function(id, taxonomyId) {
        $("#delete_form").attr('action', '/admin/taxonomy/' + taxonomyId + '/metas/'+id);
    }
</script>
@endsection
