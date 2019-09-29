@extends('themes.limitless.layouts.default')

@section('title', 'Show')

@section('load-before')

@endsection

@section('load')

@endsection

@section('pageheader')
    @include('admin.banners.includes.pageheader', ['breadcrumb' => 'banners_show'])
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <div>
                    <h6 class="card-title">
                        {{ $banner->title }}
                        @if ($banner->active)
                            <br><small class="text-success">Active</small>
                        @else
                            <br><small class="text-muted">Not Active</small>
                        @endif
                    </h6>
                </div>

                <div class="header-elements">
                    <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-light btn-sm"><span class="icon-pencil ml-2"></span> Edit</a>
                </div>
            </div>

            <div class="card-body">
                @if ($banner->starts_at || $banner->ends_at)
                    <fieldset class="content-group">
                        <legend class="font-weight-bold">Schedule</legend>

                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Starts At:</th>
                                <td>{{ $banner->starts_at }}</td>
                            </tr>
                            <tr>
                                <th>Ends At:</th>
                                <td>{{ $banner->ends_at }}</td>
                            </tr>
                            <tr>
                                <th>Duration:</th>
                                <td>{{ \Carbon\Carbon::parse($banner->ends_at)->diffInDays($banner->starts_at) }} days</td>
                            </tr>
                        </table>
                    </fieldset>
                @endif

                @if ($banner->link)
                    <fieldset class="content-group">
                        <legend class="font-weight-bold">Link</legend>
                        <p>
                            <a href="{{ $banner->link }}">{{ $banner->link }}</a>
                        </p>
                    </fieldset>
                @endif

                @if ($banner->location_id)
                    <fieldset class="content-group">
                        <legend class="font-weight-bold">Location</legend>

                        <div class="form-group">
                            <h5>
                                <a href="{{ route('admin.banners.locations.show', $banner->location_id) }}">
                                    {{ $banner->location->title }}
                                </a>
                            </h5>
                            <strong>Size: </strong><span>{{ $banner->location->width }}x{{ $banner->location->height }}</span>
                        </div>
                    </fieldset>
                @endif

                @if ($banner->banner)
                    <fieldset class="content-group">
                        <legend class="font-weight-bold">Banner Image</legend>

                        <div class="thumbnail">
                            <img src="{{ $banner->banner }}" alt="Banner Image">
                        </div>
                    </fieldset>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection

