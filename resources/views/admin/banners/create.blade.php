@extends('themes.limitless.layouts.default')

@section('title', 'New Banner')

@section('load-before')

@endsection

@section('load')
<script src="{{ asset('limitless/bootstrap4/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script src="{{ asset('limitless/bootstrap4/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script src="{{ asset('limitless/bootstrap4/js/plugins/forms/styling/switch.min.js') }}"></script>
<script src="{{ asset('limitless/bootstrap4/js/plugins/media/cropper.min.js') }}"></script>

<script src="{{ asset('limitless/bootstrap4/js/plugins/ui/moment/moment.min.js') }}"></script>
<script src="{{ asset('limitless/bootstrap4/js/plugins/pickers/daterangepicker.js') }}"></script>
<script src="{{ asset('limitless/bootstrap4/js/plugins/pickers/anytime.min.js') }}"></script>
<script src="{{ asset('limitless/bootstrap4/js/plugins/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset('limitless/bootstrap4/js/plugins/pickers/pickadate/picker.date.js') }}"></script>
<script src="{{ asset('limitless/bootstrap4/js/plugins/pickers/pickadate/picker.time.js') }}"></script>
<script src="{{ asset('limitless/bootstrap4/js/plugins/pickers/pickadate/legacy.js') }}"></script>
<style>
    .image-cropper-container img {
        max-width: 100%;
    }
</style>
@endsection

@section('pageheader')
    @include('admin.banners.includes.pageheader')
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Create Banner</h6>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {!! session('status') !!}
                        </div>
                    @endif

                    <fieldset class="content-group">
                        <legend class="font-weight-bold">General</legend>

                        <div class="form-group @error('title') has-error @enderror">
                            <label for="title" class="col-form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Winter season sale!... etc" required>
                            @error('title')
                                <div class="help-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group @error('link') has-error @enderror" id="link_group">
                            <label for="link" class="col-form-label">Link</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="link" id="link" placeholder="https://...">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modal_choose_page">Choose From Pages</button>
                                </span>
                            </div>
                            @error('link')
                                <div class="help-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </fieldset>

                    <fieldset class="content-group">
                        <legend class="font-weight-bold">Banner</legend>

                        <div class="form-group @error('location') has-error @enderror">
                            <label for="location" class="col-form-label">Location <span class="text-danger">*</span></label>
                            <select name="location" id="location" class="form-control">
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->title }}</option>
                                @endforeach
                            </select>
                            @error('location')
                                <div class="help-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group @error('banner') has-error @enderror">
                            <label for="banner" class="col-form-label">Image <span class="text-danger">*</span></label>
                            <div class="uniform-uploader">
                                <input type="file" class="form-control-uniform" name="banner" id="banner" onchange="showWebCropper(this)">
                                <span class="filename" style="user-select: none;">No file selected</span>
                                <span class="action btn btn-light" style="user-select: none;">Choose File</span>
                            </div>
                            <input type="text" name="banner_cropped" id="banner_cropped" hidden>
                            <div class="card" id="banner_preview_container" style="display: none;">
                                <div class="card-img-actions m-1">
                                    <img class="card-img img-fluid" src="{{ asset('placeholder.jpg') }}" alt="" id="banner_preview">
                                    <div class="card-img-actions-overlay card-img">
                                        <span>
                                            <button type="button" class="btn btn-info btn-sm" onclick="removeWebPreview()">Remove</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @error('banner')
                                <div class="help-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </fieldset>

                    <fieldset class="content-group">
                        <legend class="font-weight-bold">Schedule</legend>

                        <div class="form-group @error('status') has-error @enderror">
                            <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control text-capitalize">
                                @foreach (\App\Banner::STATUS_ARRAY as $status)
                                    <option value="{{ $status }}" {{ $status == \App\Banner::STATUS_DRAFT ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="help-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group @error('schedule') has-error @enderror">
                            <label for="schedule" class="col-form-label">Start & End Date <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="schedule" id="schedule" class="form-control daterange-increments" value="{{ \Carbon\Carbon::now()->format('mm/dd/YYYY h:mm a') . ' - ' . \Carbon\Carbon::now()->add('7 days')->format('mm/dd/YYYY h:mm a') }}">
                                <span class="input-group-append">
                                    <span class="input-group-text"><i class="icon-calendar22"></i></span>
                                </span>
                            </div>
                            @error('schedule')
                                <div class="help-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </fieldset>

                    <div class="text-right">
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-light">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="modal_web_crop" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-elements-inline">
                <h6 class="modal-title">Crop Banner Image</h6>
                <div class="header-elements">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <div class="image-cropper-container">
                    <img src="{{ asset('placeholder.jpg') }}" alt="" id="modal_banner_crop_image">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="cropWebImage()">Crop Image</button>
            </div>
        </div>
    </div>
</div>

<div id="modal_choose_page" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-elements-inline">
                <h6 class="modal-title">Choose from Pages</h6>
                <div class="header-elements">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>

            <div class="modal-body">
                <ul class="media-list media-list-bordered">
                    @foreach ($pages as $index => $page)
                    <li class="media">
                        <div class="mr-3">
                            <h5 class="text-center">{{ $index + 1 }}</h5>
                        </div>

                        <div class="media-body">
                            <h6 class="media-heading">
                                {{ $page->title }}
                                <br><small><a href="{{ url($page->slug) }}" target="_blank">{{ url($page->slug) }}</a></small>
                            </h6>
                        </div>

                        <div class="ml-3">
                            <button type="button" class="btn btn-light" onclick="choosePage('{{ url($page->slug) }}')">Choose</button>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var webElement = $("#modal_banner_crop_image");
    var options = {
        responsive: true,
        center: true,
        minContainerWidth: 558,
        minContainerHeight: 400
    };

    webElement.cropper(options);

    var webCropper = webElement.data('cropper');

    var locations = JSON.parse('{!! json_encode($locations) !!}');

    function gcd (a, b) {
        return (b == 0) ? a : gcd (b, a%b);
    }

    function selectLocation(locationId) {
        locations.forEach(location => {
            if (location.id == locationId) {
                var ratio = gcd(location.width, location.height);
                var aspect = (location.width/ratio) / (location.height/ratio)
                webCropper.setAspectRatio(aspect);
            }
        });
    }

    function showWebCropper(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                webElement.attr('src', e.target.result);
                webCropper.replace(e.target.result);
            }

            reader.readAsDataURL(input.files[0]);

            $("#modal_web_crop").modal('toggle');
        }
    }

    function cropWebImage() {
        var canvas = webCropper.getCroppedCanvas().toBlob((blob) => {
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;
                $("#modal_web_crop").modal('toggle');
                $("#banner_preview_container").show();
                $("#banner_preview").attr('src', base64data);
                $("#banner_cropped").val(base64data);
            }
        });
    }

    function removeWebPreview() {
        $("#banner_preview_container").hide();
        $("#banner").val('');

        $(".file-styled").uniform({
            fileButtonClass: 'action btn btn-light'
        });
    }

    function choosePage(url) {
        document.getElementById('link').value = url;

        $('#modal_choose_page').modal('hide');
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Checkboxes/radios (Uniform)
        // ------------------------------

        // Default initialization
        $(".styled").uniform();

        // File input
        $(".file-styled").uniform({
            fileButtonClass: 'action btn btn-light'
        });

        // 10 minute increments
        $('.daterange-increments').daterangepicker({
            timePicker: true,
            opens: 'left',
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-light',
            locale: {
                format: 'MM/DD/YYYY h:mm a'
            }
        });

        selectLocation($("#location").val());

        $("#location").on('change', function () {
            selectLocation($(this).val());
        });
    });
</script>
@endsection

