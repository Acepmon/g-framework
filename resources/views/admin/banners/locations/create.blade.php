@extends('themes.limitless.layouts.default')

@section('title', 'Create Banner Location')

@section('load-before')

@endsection

@section('load')

@endsection

@section('pageheader')
    @include('admin.banners.includes.pageheader', , ['breadcrumb' => 'banners_locations_index'])
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <form action="{{ route('admin.banners.locations.store') }}" method="POST">
            @csrf

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Create New Location</h6>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {!! session('status') !!}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="title" class="col-form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>

                    <div class="form-group">
                        <label for="width" class="col-form-label">Width</label>
                        <input type="number" class="form-control" name="width" id="width">
                    </div>

                    <div class="form-group">
                        <label for="height" class="col-form-label">Height</label>
                        <input type="number" class="form-control" name="height" id="height">
                    </div>

                    <div class="form-group">
                        <label for="type" class="col-form-label">Type</label>
                        <select class="form-control text-capitalize" name="type" id="type">
                            @foreach (\App\BannerLocation::TYPE_ARRAY as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
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
@endsection

@section('script')

@endsection

