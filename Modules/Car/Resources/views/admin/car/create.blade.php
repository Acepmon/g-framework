@extends('themes.limitless.layouts.default')

@section('title', 'New Car Content')

@section('load')
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/demo_pages/picker_date.js')}}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/forms/tags/tagsinput.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/forms/tags/tokenfield.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/demo_pages/form_tags_input.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/demo_pages/form_checkboxes_radios.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/demo_pages/form_select2.js') }}"></script>
@endsection
@section('load-before')
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/loaders/pace.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/forms/validation/validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/forms/inputs/touchspin.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/forms/styling/switch.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/demo_pages/form_validation.js') }}"></script>

<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/ui/moment/moment.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/pickers/anytime.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/pickers/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/pickers/pickadate/picker.js')}}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/pickers/pickadate/picker.date.js')}}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/pickers/pickadate/picker.time.js')}}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/pickers/pickadate/legacy.js')}}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/media/cropper.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/uploaders/fileinput/plugins/purify.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/uploaders/fileinput/plugins/sortable.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>

@endsection

@section('pageheader')
    @include('car::admin.car.includes.pageheader')
@endsection

@section('content')

<!-- Grid -->
<div class="row">
    <div class="col-md-12">

        <!-- Horizontal form -->
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.modules.car.store') }}" enctype="multipart/form-data" method="POST" id="form">
                    @csrf

                    @if(Session::has('error'))
                    <div class="alert alert-danger no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                        {{ session('error') }}
                    </div>
                    @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger no-border">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                            {{ $error }}
                        </div>
                        @endforeach
                    @endif

                    <div class="form-group row">
                        <label for="title" class="col-form-label col-lg-2">Title <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input id="title" type="text" class="form-control" name="title" placeholder="Гарчиг..." required="required" aria-required="true" invalid="true">
                        </div>
                    </div>
                    <input id="slug" type="hidden" class="form-control" name="slug" placeholder="Enter content slug..." required="required" aria-required="true" invalid="true" value="{{ \Str::uuid() }}">

                    <input type="hidden" name="type" value="car"/>

                    <div class="form-group row">
                        <label for="status" class="col-form-label col-lg-2">Status <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select id="status" name="status" required="required" class="form-control text-capitalize">
                                @foreach(App\Content::STATUS_ARRAY as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="visibility" class="col-form-label col-lg-2">Visibility <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select id="visibility" name="visibility" required="required" class="form-control text-capitalize">
                                @foreach(App\Content::VISIBILITY_ARRAY as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <input name="author_id" type="text" id="author_id" value="{{ Auth::id() }}" hidden>
                    <hr>

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <h4>General information</h4>

                            <div class="form-group row">
                                <label for="manufacturer" class="col-form-label col-lg-2">Manufacturer</label>
                                <div class="col-lg-10">
                                    <select id="manufacturer" name="markName" class="select text-capitalize">
                                        <option value="">Үйлдвэрлэгч</option>
                                        @foreach(App\TermTaxonomy::where('taxonomy', 'car-manufacturer')->get() as $value)
                                            <option value="{{ $value->term->name }}">{{ $value->term->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="modelName" class="col-form-label col-lg-2">Model</label>
                                <div class="col-lg-10">
                                    <select id="modelName" name="modelName" class="form-control text-capitalize">
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="capacityAmount" class="col-form-label col-lg-2">Displacement</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <input id="capacityAmount" type="number" class="form-control" name="capacityAmount" placeholder="Багтаамж..." invalid="true">
                                        <input type="hidden" class="form-control" name="capacityUnit" value="cc">
                                        <span class="input-group-append">
                                            <span class="input-group-text">cc</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="buildYear" class="col-form-label col-lg-2">Build Year</label>
                                <div class="col-lg-10">
                                    <input id="buildYear" type="number" min="1769" max="2019" value="2019" class="form-control" name="buildYear" placeholder="Үйлдвэрлэгдсэн он..." invalid="true">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="importDate" class="col-form-label col-lg-2">Import Date</label>
                                <div class="col-lg-10">
                                    <input id="importDate" type="number" min="1769" max="2019" value="2019" class="form-control" name="importDate" placeholder="Орж ирсэн он..." invalid="true">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="colorName" class="col-form-label col-lg-2">Color</label>
                                <div class="col-lg-10">
                                    <select id="colorName" name="colorName" class="select text-capitalize">
                                        @foreach(App\TermTaxonomy::where('taxonomy', 'car-colors')->get() as $value)
                                            <option value="{{ $value->term->name }}">{{ $value->term->metaValue('value') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="vin" class="col-form-label col-lg-2">VIN</label>
                                <div class="col-lg-10">
                                    <input id="vin" type="text" class="form-control" name="vin" placeholder="Машины дугаар..." invalid="true">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <h4>More information</h4>

                            <div class="form-group row">
                                <label for="mileage" class="col-form-label col-lg-2">Mileage</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <input id="mileage" type="number" class="form-control" name="mileage" placeholder="Явсан км..." invalid="true" class="touchspin-postfix">
                                        <span class="input-group-append">
                                            <span class="input-group-text">km</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="wheelPosition" class="col-form-label col-lg-2">Steering wheel</label>
                                <div class="col-lg-10">
                                    <select id="wheelPosition" name="wheelPosition" class="form-control text-capitalize">
                                        @foreach(App\TermTaxonomy::where('taxonomy', 'car-wheel-pos')->get() as $value)
                                            <option value="{{ $value->term->name }}">{{ $value->term->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fuel" class="col-form-label col-lg-2">Type of fuel</label>
                                <div class="col-lg-10">
                                    <select id="fuel" name="fuel" class="form-control text-capitalize">
                                        @foreach(App\TermTaxonomy::where('taxonomy', 'car-fuel')->get() as $value)
                                            <option value="{{ $value->term->name }}">{{ $value->term->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="transmission" class="col-form-label col-lg-2">Transmission</label>
                                <div class="col-lg-10">
                                    <select id="transmission" name="transmission" class="form-control text-capitalize">
                                        @foreach(App\TermTaxonomy::where('taxonomy', 'car-transmission')->get() as $value)
                                            <option value="{{ $value->term->name }}">{{ $value->term->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="manCount" class="col-form-label col-lg-2">Seating</label>
                                <div class="col-lg-10">
                                    <select id="manCount" name="manCount" class="form-control text-capitalize">
                                        @foreach(App\TermTaxonomy::where('taxonomy', 'car-mancount')->get() as $value)
                                            <option value="{{ $value->term->name }}">{{ $value->term->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="wheelDrive" class="col-form-label col-lg-2">Wheel drive</label>
                                <div class="col-lg-10">
                                    <select id="wheelDrive" name="wheelDrive" class="form-control text-capitalize">
                                        @foreach(App\TermTaxonomy::where('taxonomy', 'car-wheel')->get() as $value)
                                            <option value="{{ $value->term->name }}">{{ $value->term->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="advantages" class="col-form-label col-lg-2">Advantages</label>
                                <div class="col-lg-10">
                                    <input type="text" name="advantages" id="advantages" class="form-control tokenfield" value="" placeholder="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sellerDescription" class="col-form-label col-lg-2">Seller description</label>
                                <div class="col-lg-10">
                                    <textarea id="sellerDescription" type="text" class="form-control" name="sellerDescription" placeholder="Нэмэлт мэдээлэл..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <h4>Media</h4>

                            <div class="form-group row">
                                <label for="price" class="col-form-label col-lg-2">Price</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <input id="price" type="number" min="0" value="0" class="form-control" name="price" placeholder="Үнэ..." invalid="true" class="touchspin-postfix">
                                        <span class="input-group-append">
                                            <span class="input-group-text">₮</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="priceType" class="col-form-label col-lg-2">Price Type</label>
                                <div class="col-lg-10">
                                    <select id="priceType" name="priceType" class="form-control text-capitalize">
                                        @foreach(App\TermTaxonomy::where('taxonomy', 'price-type')->get() as $value)
                                            <option value="{{ $value->term->name }}">{{ $value->term->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="link" class="col-form-label col-lg-2">YouTube Link</label>
                                <div class="col-lg-10">
                                    <input id="link" type="text" class="form-control file-styled" name="youtubeLink" onchange="embedLink(this)">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div id="video-container"></div>
                            </div>

                            <div class="form-group row">
                                <label for="thumbnail" class="col-form-label col-lg-2">Thumbnail</label>
                                <div class="col-lg-10">
                                    <div class="uniform-uploader">
                                        <input id="thumbnail" type="file" name="thumbnail" class="form-control-uniform" invalid="true" onchange="previewMedia(this, 'thumbnail-container')" data-fouc="">
                                        <span class="filename" style="user-select: none;">No file selected</span>
                                        <span class="action btn btn-light" style="user-select: none;">Choose File</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10" id="thumbnail-container"></div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <h4>Auction Section</h4>

                            <div class="form-group row">
                                <label for="buyout" class="col-form-label col-lg-2">Buyout</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <input id="buyout" type="number" min="0" class="form-control" name="buyout" placeholder="Шууд авах үнэ..." invalid="true" class="touchspin-postfix">
                                        <span class="input-group-append">
                                            <span class="input-group-text">₮</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="startPrice" class="col-form-label col-lg-2">Bid Starting Price</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <input id="startPrice" type="number" min="0" class="form-control" name="startPrice" placeholder="Эхлэх үнэ..." invalid="true" class="touchspin-postfix">
                                        <span class="input-group-append">
                                            <span class="input-group-text">₮</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="maxBid" class="col-form-label col-lg-2">Reserve Price</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <input id="maxBid" type="number" min="0" class="form-control" name="reservePrice" placeholder="Зарагдах доод үнэ..." invalid="true" class="touchspin-postfix">
                                        <span class="input-group-append">
                                            <span class="input-group-text">₮</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="startsAt" class="col-form-label col-lg-2">Starts At</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <button class="btn btn-light btn-icon" type="button" id="startsAtBut"><i class="icon-calendar3"></i></button>
                                        </span>
                                        <input type="text" class="form-control" id="startsAt" name="startsAt" placeholder="Эхлэх хугацаа">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="endsAt" class="col-form-label col-lg-2">Ends At</label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <button class="btn btn-light btn-icon" type="button" id="endsAtBut"><i class="icon-calendar3"></i></button>
                                        </span>
                                        <input type="text" class="form-control" id="endsAt" name="endsAt" placeholder="Дуусах хугацаа">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="medias" class="col-form-label col-lg-2">Images</label>
                                <div class="col-lg-10">
                                    <div class="uniform-uploader">
                                        <input id="media" type="file" name="medias[]" class="form-control-uniform" invalid="true" onchange="previewMedia(this, 'image-container')" multiple data-fouc="">
                                        <span class="filename" style="user-select: none;">No file selected</span>
                                        <span class="action btn btn-light" style="user-select: none;">Choose File</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-10" id="image-container"></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Car Option</h4>
                            <div class="form-group row">
                                <div class="accordion" id="accordionExample" style="width: 100%">
                                    <div class="card">
                                        <div class="accordian-head" id="guts-accordian">
                                            <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#guts" aria-expanded="false" aria-controls="guts">
                                                Guts <i class="fab fa fa-angle-down"></i>
                                            </button>
                                            </h2>
                                        </div>
                                        <div id="guts" class="collapse" aria-labelledby="guts-accordian" data-parent="#accordionExample">
                                            <div class="card-body bg-light">
                                                @foreach(App\TermTaxonomy::where('taxonomy', 'car-guts')->get() as $taxonomy)
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="{{ $taxonomy->term->name }}" name="{{ $taxonomy->term->name }}" class="custom-control-input">
                                                    <label class="custom-control-label  d-flex justify-content-between" for="{{ $taxonomy->term->name }}">{{ $taxonomy->term->name }}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="accordian-head" id="safety-accordian">
                                            <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#safety" aria-expanded="false" aria-controls="safety">
                                                Safety <i class="fab fa fa-angle-down"></i>
                                            </button>
                                            </h2>
                                        </div>
                                        <div id="safety" class="collapse" aria-labelledby="safety-accordian" data-parent="#accordionExample">
                                            <div class="card-body bg-light">
                                                @foreach(App\TermTaxonomy::where('taxonomy', 'car-safety')->get() as $taxonomy)
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="{{ $taxonomy->term->name }}" name="{{ $taxonomy->term->name }}" class="custom-control-input">
                                                    <label class="custom-control-label  d-flex justify-content-between" for="{{ $taxonomy->term->name }}">{{ $taxonomy->term->name }}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="accordian-head" id="exterior-accordian">
                                            <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#exterior" aria-expanded="false" aria-controls="exterior">
                                                Exterior <i class="fab fa fa-angle-down"></i>
                                            </button>
                                            </h2>
                                        </div>
                                        <div id="exterior" class="collapse" aria-labelledby="exterior-accordian" data-parent="#accordionExample">
                                            <div class="card-body bg-light">
                                                @foreach(App\TermTaxonomy::where('taxonomy', 'car-exterior')->get() as $taxonomy)
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="{{ $taxonomy->term->name }}" name="{{ $taxonomy->term->name }}" class="custom-control-input">
                                                    <label class="custom-control-label  d-flex justify-content-between" for="{{ $taxonomy->term->name }}">{{ $taxonomy->term->name }}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="accordian-head" id="convenience-accordian">
                                            <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#convenience" aria-expanded="false" aria-controls="convenience">
                                            Convenience <i class="fab fa fa-angle-down"></i>
                                            </button>
                                            </h2>
                                        </div>
                                        <div id="convenience" class="collapse" aria-labelledby="convenience-accordian" data-parent="#accordionExample">
                                            <div class="card-body bg-light">
                                                @foreach(App\TermTaxonomy::where('taxonomy', 'car-convenience')->get() as $taxonomy)
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="{{ $taxonomy->term->name }}" name="{{ $taxonomy->term->name }}" class="custom-control-input">
                                                    <label class="custom-control-label  d-flex justify-content-between" for="{{ $taxonomy->term->name }}">{{ $taxonomy->term->name }}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="best-premium" name="premium" class="custom-control-input">
                                <label class="custom-control-label h4 d-flex justify-content-between" for="best-premium">Best Premium</label>
                            </div>
                            <select id="best-premium-choice" name="best-premium-choice" class="form-control select text-capitalize">
                                <option value="1-day">1 Day, 25,000</option>
                            </select>
                            <p class="text-muted">5 дахин хурдан худалдана.</p>
                            <p class="text-muted">Нүүр хуудасны хамгийн эхэнд харагдана.</p>
                            <p class="text-muted">Бүх энгийн зарын дээр.</p>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="premium" name="premium" class="custom-control-input">
                                <label class="custom-control-label h4 d-flex justify-content-between" for="premium">Premium</label>
                            </div>
                            <select id="premium-choice" name="premium-choice" class="form-control select text-capitalize">
                                <option value="1-day">1 Day, 25,000</option>
                            </select>
                            <p class="text-muted">5 дахин хурдан худалдана.</p>
                            <p class="text-muted">Нүүр хуудасны хамгийн эхэнд харагдана.</p>
                            <p class="text-muted">Бүх энгийн зарын дээр.</p>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="free" name="premium" class="custom-control-input">
                                <label class="custom-control-label h4 d-flex justify-content-between" for="free">Free</label>
                            </div>
                            <p class="text-muted">5 дахин хурдан худалдана.</p>
                            <p class="text-muted">Нүүр хуудасны хамгийн эхэнд харагдана.</p>
                            <p class="text-muted">Бүх энгийн зарын дээр.</p>

                        </div>
                        <div class="col-lg-6">
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="javascript:history.back()" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /horizotal form -->

    </div>
</div>
<!-- /grid -->

<div class="modal fade docs-cropped" id="getCroppedCanvasModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title" id="getCroppedCanvasTitle">Crop your image</h6>
            </div>
            <div class="modal-body" id="cropBody">
                <div class="img-cropper-container" class="col-lg-12">
                    <img id="cropImage" class="croppable">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="cropImage()">Done</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    var modelData = {
        @foreach(App\TermTaxonomy::where('taxonomy', 'car-manufacturer')->get() as $taxonomy)
        '{{ $taxonomy->term->name}}': [
            @foreach($taxonomy->children as $model)
            '{{ $model->term->name }}',
            @endforeach
        ],
        @endforeach
    };

    $(document).ready(function(){
        var theme_layouts = [{
            "text": "default",
            "theme_id": "0",
            "value": "layouts.app"
        }];
        @foreach ($themes as $theme)
            @if(File::exists(resource_path('views/themes/'.$theme->package.'/layouts')))
            @foreach(File::files(resource_path('views/themes/'.$theme->package.'/layouts')) as $path)
                theme_layouts.push({
                    "text": "{{ str_replace('.blade.php', '', $path->getFilename()) }}",
                    "theme_id": "{{ $theme->id }}",
                    "value": "{{ 'themes.' . $theme->package . '.layouts.' . str_replace('.blade.php', '', $path->getFilename()) }}"
                });
            @endforeach
            @endif
        @endforeach

        $("#theme").change(function() {
            $("#layout").children().remove();
            var selected_value = $(this).val();
            $.each(theme_layouts, function(index, option) {
                if (selected_value === option.theme_id) {
                    $("#layout").append(new Option(option.text, option.value));
                }
            });
        });
        $("#theme").prop('selectedIndex', 0).trigger('change');

        $('#manufacturer').change(function (){
            var val = $(this).val();
            $('#modelName').html('');
            for(var element in modelData[val]) {
                $("#modelName").append('<option>' + modelData[val][element] + '</option>');
            }
        });

        $(".file-input-ajax").fileinput({
            uploadUrl: "http://localhost", // server upload action
            uploadAsync: true,
            maxFileCount: 5,
            initialPreview: [],
            fileActionSettings: {
                removeIcon: '<i class="icon-bin"></i>',
                removeClass: 'btn btn-link btn-xs btn-icon',
                uploadIcon: '<i class="icon-upload"></i>',
                uploadClass: 'btn btn-link btn-xs btn-icon',
                zoomIcon: '<i class="icon-zoomin3"></i>',
                zoomClass: 'btn btn-link btn-xs btn-icon',
                indicatorNew: '<i class="icon-file-plus text-slate"></i>',
                indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
                indicatorError: '<i class="icon-cross2 text-danger"></i>',
                indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
            },
            layoutTemplates: {
                icon: '<i class="icon-file-check"></i>',
                modal: modalTemplate
            },
            initialCaption: "No file selected",
            previewZoomButtonClasses: previewZoomButtonClasses,
            previewZoomButtonIcons: previewZoomButtonIcons
        });
    });

    function cropImage() {
        var cropData = [];
        var container;
        $("#cropBody img").each(function() {
            var image = $(this);

            container = image.attr('alt');
            var cropped = image.cropper('getCroppedCanvas', {});

            if (cropped) {
                if (container == 'thumbnail-container') {
                    $("#" + container).empty();
                    $("#thumbnailCrop").val(JSON.stringify(image.cropper('getData')));
                } else {
                    cropData.push(image.cropper('getData'));
                }
                $("#" + container).append(' \
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-10"> \
                        <img src="'+cropped.toDataURL('image/jpeg')+'" class="col-lg-12"> \
                    </div>');

                    image.attr('src', '');
                }
        });
        if (container != 'thumbnail-container') {
            $("#imagesCrop").val(JSON.stringify(cropData));
        }
    }

    function previewMedia(input, container) {
        $("#cropBody").empty();
        $(input.files).each(function(index, value) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#cropBody").append(' \
                    <div class="image-cropper-container" class="col-lg-12""> \
                        <img src="'+e.target.result+'" id="cropImage'+index+'" class="col-lg-12">\
                    </div>');

                $("#cropImage"+index).attr('src', e.target.result);
                $("#cropImage"+index).attr('alt', container);
                $('#cropImage'+index).cropper({
                    dragMode: 'move',
                    aspectRatio: 16 / 9,
                    autoCropArea: 0.8,
                    restore: false,
                    guides: false,
                    center: true,
                    highlight: false,
                    cropBoxMovable: false,
                    cropBoxResizable: false,
                    toggleDragModeOnDblclick: false,
                });

                $("#getCroppedCanvasModal").modal('show');
            };
            reader.readAsDataURL(value);
        });
    }

    function embedLink(input) {
        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var match = input.value.match(regExp);

        if (match && match[2].length == 11) {
            $("#video-container").empty().append(' \
            <iframe width="560" height="315" src="//www.youtube.com/embed/' + match[2]
            +'" frameborder="0" allowfullscreen></iframe>');
        }
    }

    function create_slug() {
        var title = document.getElementById("title").value;
        title = title.toString().toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[\s\W-]+/g, '-')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
        document.getElementById("slug").value = title;

    }

    function carConditionChanged(value) {
        if (value == 'Used') {
            $("#plateNumber").css('visibility', 'visible');
        } else {
            $("#plateNumber").css('visibility', 'hidden');
        }
    }

    // $("#modelName").select2({
    //     tags: true,
    //     //maximumSelectionLength: 1
    // });

    $('#endsAtBut').click(function (e) {
        $('#endsAt').AnyTime_noPicker().AnyTime_picker().focus();
        e.preventDefault();
    });

    $('#startsAtBut').click(function (e) {
        $('#startsAt').AnyTime_noPicker().AnyTime_picker().focus();
        e.preventDefault();
    });

    $("#type").change(function () {
        if ($(this).val() == 'page') {
            $("#theme_options").css('display', 'block');
        } else {
            $("#theme_options").css('display', 'none');
        }
    });

</script>
@endsection
