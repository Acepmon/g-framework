@extends('themes.limitless.layouts.default')

@section('title', 'New Notification Template')

@section('load')

@endsection

@section('pageheader')
    @include('admin.notifications.includes.pageheader')
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.notifications.store') }}" method="POST">
                    @csrf
                    @if(Session::has('error'))
                    <div class="alert alert-danger no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Add New Notifications</h5>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter notification title..." required>
                            </div>

                            <div class="form-group">
                                <label for="type">Type <span class="text-danger">*</span></label>
                                <select name="type" id="type" class="form-control text-capitalize" required>
                                    @foreach ($types as $type)
                                    <option value="{{ $type->term->name }}">{{ $type->term->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="type">Body</label>
                                <textarea rows="5" cols="5" class="form-control" name="body" placeholder="Enter notification body..."></textarea>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('admin.notifications.index') }}" class="btn btn-light">List</a>
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection

