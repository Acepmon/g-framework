@extends('themes.limitless.layouts.default')

@section('title', 'Edit Banner Location')

@section('load-before')

@endsection

@section('load')

@endsection

@section('pageheader')
    @include('admin.banners.includes.pageheader', ['breadcrumb' => 'banners_locations_edit'])
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <form action="{{ route('admin.banners.locations.update', $location->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Edit Banner</h6>

                    <div class="header-elements">
                        <a href="#modal_banner_location_remove" data-toggle="modal" class="btn btn-light"><span class="icon-trash position-left"></span> Delete</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {!! session('status') !!}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="title" class="col-form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ $location->title }}">
                    </div>

                    <div class="form-group">
                        <label for="width" class="col-form-label">Width</label>
                        <input type="number" class="form-control" name="width" id="width" value="{{ $location->width }}">
                    </div>

                    <div class="form-group">
                        <label for="height" class="col-form-label">Height</label>
                        <input type="number" class="form-control" name="height" id="height" value="{{ $location->height }}">
                    </div>

                    <div class="form-group">
                        <label for="type" class="col-form-label">Type</label>
                        <select class="form-control text-capitalize" name="type" id="type">
                            @foreach (\App\BannerLocation::TYPE_ARRAY as $type)
                                <option value="{{ $type }}" {{ $location->type == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="modal_banner_location_remove" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-elements-inline">
                <h6 class="modal-title">Remove Banner Location</h6>
                <div class="header-elements">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <p>
                    Are you sure you want to remove banner location?
                </p>
            </div>

            <div class="modal-footer">
                <form action="{{ route('admin.banners.locations.destroy', $location->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Remove</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection

