@extends('themes.limitless.layouts.default')

@section('load')
@endsection

@section('pageheader')
    @include('admin.notifications.includes.pageheader')
@endsection

@section('content')

<!-- Grid -->
<div class="row">
    <div class="col-md-7">

        <!-- Horizontal form -->
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Title</label>
                    <div class="col-lg-10">
                        <label class="col-form-label col-lg-2">{{$notification->title}}</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Body</label>
                    <div class="col-lg-10">
                        <label class="col-form-label col-lg-2">{{$notification->metaValue('body')}}</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Author</label>
                    <div class="col-lg-10">
                        @include('themes.limitless.includes.user-media', ['user' => $notification->author])
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Created at</label>
                    <div class="col-lg-10">
                        <label class="col-form-label col-lg-2">{{$notification->created_at}}&nbsp;</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Read</label>
                    <div class="col-lg-10">
                        {{ $count }}
                    </div>
                </div>
                <div class="text-right" style="padding-bottom: 5px">
                    <a href="{{ route('admin.notifications.index') }}" class="btn btn-light">Back</a>
                    <a href="{{ route('admin.notifications.edit', ['id' => $notification->id]) }}" class="btn btn-light">Edit</a>
                </div>
            </div>
        </div>
        <!-- /horizotal form -->
    </div>
</div>
<!-- /grid -->

@endsection

@section('script')
@endsection
