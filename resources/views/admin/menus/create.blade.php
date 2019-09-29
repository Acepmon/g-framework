@extends('themes.limitless.layouts.default')

@section('title', 'Create Menu')

@section('load')
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/extensions/jquery_ui/core.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>

<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/demo_pages/multiselect.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/demo_pages/form_select2.js') }}"></script>
@endsection

@section('pageheader')
    @include('admin.menus.includes.pageheader', ['breadcrumb' => 'menus_create'])
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Create New Menu</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.menus.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="title" class="col-form-label">Title <span class="text-danger">*</span></label>
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Menu title" value="{{ old('title') }}" required autocomplete="title">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="link" class="col-form-label">Link</label>
                        <div class="input-group">
                            <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" placeholder="https://..." value="{{ old('link') }}" required autocomplete="link">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modal_choose_page">Choose From Pages</button>
                            </span>
                        </div>
                        @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="icon" class="col-form-label">Icon</label>
                        <div class="input-group">
                            <input id="icon" type="text" class="form-control @error('icon') is-invalid @enderror" name="icon" placeholder="Menu icon" value="{{ old('icon') }}" required autocomplete="icon">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modal_choose_icon">Choose Icon</button>
                            </span>
                        </div>
                        @error('icon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="text-right">
                        <a class="btn btn-light" href="javascript:history.back()" type="btn btn-primary"><i class="icon-arrow-left13 ml-2"></i>Back</a>
                        <button type="submit" class="btn btn-success">Submit
                            <i class="icon-arrow-right14 mr-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_choose_page" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Choose from Pages</h6>
            </div>

            <div class="modal-body">
                <ul class="media-list media-list-bordered">
                    @foreach ($pages as $index => $page)
                    <li class="media">
                        <div class="media-left">
                            <h5 class="text-center">{{ $index + 1 }}</h5>
                        </div>

                        <div class="media-body">
                            <h6 class="media-heading">{{ $page->title }}</h6>
                            <small><a href="{{ url($page->slug) }}" target="_blank">{{ url($page->slug) }}</a></small>
                        </div>

                        <div class="media-right">
                            <button type="button" class="btn btn-light" onclick="choosePage('{{ url($page->slug) }}')">Choose</button>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="modal_choose_icon" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Icomoon icon set</h6>
            </div>

            <div class="modal-body">
                <p class="content-group">Icomoon is a custom icon set, includes 1145 icon glyphs based on 16px grid. This set is a <code>default</code> icon set of the template, majority of components are using Icomoon font family for UI elements instead of images, so all of them are retina-ready. <code>Glyphicon</code> and <code>FontAwesome</code> icon sets are also added, but as optional choice. In order to get the best look of UI elements, I recommend to include this icon set only as you can find perfectly crafted icons according to most of your common needs.</p>

                <div class="row glyphs">
                    @foreach ($icons as $icon)
                    <div class="col-md-3 col-sm-4" onclick="chooseIcon('{{$icon}}')"><i class="{{$icon}}"></i> {{$icon}}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal_choose_parent" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Choose Parent Menu</h6>
            </div>

            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function choosePage(url) {
        document.getElementById('link').value = url;

        $('#modal_choose_page').modal('hide');
    }

    function chooseIcon(icon) {
        document.getElementById('icon').value = icon;

        $('#modal_choose_icon').modal('hide');
    }

    function chooseParent(parentId) {
        document.getElementById('parent_id').value = parentId;

        $('#modal_choose_parent').modal('hide');
    }
</script>
@endsection
