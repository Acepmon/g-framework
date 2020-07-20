@extends('themes.limitless.layouts.default')

@section('load')
@endsection

@section('pageheader')
    @include('admin.notifications.includes.pageheader')
@endsection

@section('content')

<!-- Grid -->
<div class="row">
    <div class="col-sm-7">

        <!-- Horizontal form -->
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.notifications.update', ['id' => $notification->id]) }}" method="POST">
                    @method('PUT')
                    @csrf

                    @if(Session::has('success'))
                    <div class="alert alert-success no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                        {{ session('success') }}
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Title <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input id="title" type="text" class="form-control" name="title" placeholder="Enter title..." required="required" aria-required="true" invalid="true" value="{{ $notification->title }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Body</label>
                        <div class="col-lg-10">
                            <textarea rows="5" cols="5" class="form-control" name="body" placeholder="Enter notification body...">{{ $notification->metaValue("body") }}</textarea>
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('admin.notifications.index') }}" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /horizotal form -->
    </div>
</div>
<!-- /grid -->

@endsection

@section('script')
@endsection
