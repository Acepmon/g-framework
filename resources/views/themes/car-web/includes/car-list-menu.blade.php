@php
$categorySlug = [
'car-type', 'car-manufacturer', 'car-year', 'car-distance-driven', 'car-price', 'car-colors', 'car-fuel', 'car-transmission', 'car-options', 'car-mancount', 'car-wheel-pos', 'provinces', 'car-doctor-verified'
];
$categoryName = [
'Төрөл', 'Үйлдвэрлэгч/Модел', 'Жил', 'Явсан КМ', 'Үнэ', 'Өнгө', 'Шатахуун', 'Араа', 'Option', 'Зорчигч', 'Жолоо', 'Байршил', 'Doctor баталгаажсан'
];
@endphp

<div class="car-filter accordion shadow-soft-blue" id="accordionExample">
    @foreach($categorySlug as $index=>$category)
    <div class="card">
        <div class="accordian-head" id="{{ $category }}-accordion">
        <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#{{ $category }}" aria-expanded="false" aria-controls="{{ $category }}">
            {{ $categoryName[$index] }}<i class="fab fa fa-angle-down"></i>
            </button>
        </h2>
        </div>

        @if($category == 'car-type')
        <div id="{{ $category }}" class="collapse {{ request($category, False)?'show':'' }}" aria-labelledby="{{ $category }}">
        <div class="card-body bg-light grid-radio gr-3">
            @foreach(App\TermTaxonomy::where('taxonomy', $category)->get() as $taxonomy)
            <div class="cd-radio">
            <input type="radio" id="{{ $taxonomy->term->metaValue('value') }}" name="{{ $category }}" class="custom-control-input" value="{{ $taxonomy->term->name }}" {{ ($taxonomy->term->name == $request['carType'])?'checked':''}}>
            <label class="custom-control-label " for="{{ $taxonomy->term->metaValue('value') }}">
                <img src="{{ asset('car-web/img/icons/'.strtolower($taxonomy->term->metaValue('value')).'.svg') }}">
                <span>{{ $taxonomy->term->name }}</span>
            </label>
            </div>
            @endforeach
        </div>
        </div>
        @elseif($category == 'car-manufacturer')
        <div id="{{ $category }}" class="collapse {{ request($category, False)?'show':'' }}" aria-labelledby="{{ $category }}">
        <div id="manufacturerBody" class="card-body bg-light">
            <div class="manufacturer">
                @foreach(App\Entities\TaxonomyManager::getManufacturers() as $taxonomy)
                <div class="custom-control custom-radio">
                    <!-- <a href="/car-list?{{ $category . '=' . $taxonomy->term->name }}" class="text-body text-decoration-none"> -->
                    <input type="radio" id="{{$taxonomy->term->name}}" name="{{ $category }}" class="custom-control-input car-manufacturer" value="{{ $taxonomy->term->name }}" {{ ($taxonomy->term->name == request($category, Null))?'checked':'' }}>
                    <label class="custom-control-label  d-flex justify-content-between" for="{{$taxonomy->term->name}}">{{ $taxonomy->term->name }}
                    </label>
                </div>
                @endforeach
            </div>
            @if(request('car-model', Null))
            <div class="models" name="{{ request('car-manufacturer', 'no-id') }}" style="display: none">
                <div class="models-back" style="cursor:pointer"><i class="fab fa fa-angle-left"></i> буцах</div> 
                @foreach(App\TermTaxonomy::where('taxonomy', 'car-' . \Str::kebab(request('car-manufacturer', 'no-id')))->get() as $taxonomy)
                <div class="custom-control custom-radio">
                    <input type="radio" id="{{$taxonomy->term->name}}" name="car-model" class="custom-control-input" value="{{ $taxonomy->term->name }}" {{ ($taxonomy->term->name == request('car-model', Null))?'checked':'' }}>
                    <label class="custom-control-label  d-flex justify-content-between" for="{{$taxonomy->term->name}}">{{ $taxonomy->term->name }}
                    </label>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        </div>
        @elseif($category == 'car-year')
        <div id="{{ $category }}" class="collapse {{ request('buildYear', False)?'show':'' }}" aria-labelledby="{{ $category }}">
        <div class="card-body bg-light grid-radio">
            <select id="min-year" class="form-control" name="buildYear" onchange="formSubmit('buildYear','no-value')">
            <option value="">Жил сонгох</option>
            @for($i=date('Y'); $i>=1990; $i--)
            <option value="{{ $i }}" {{ $request['buildYear']==$i?'selected':'' }}>{{ $i }}</option>
            @endfor
            </select>
        </div>
        </div>
        @elseif($category == 'car-distance-driven')
        <div id="{{ $category }}" class="collapse {{ request('mileageAmount', False)?'show':'' }}" aria-labelledby="{{ $category }}">
        <div class="card-body bg-light grid-radio">
            <select id="mileageAmount" class="form-control" name="mileageAmount" onchange="formSubmit('mileageAmount','no-value')">
            <option value="">Явсан КМ сонгох</option>
            <option value="0-0" {{ $request['mileageAmount']=='0-0'?'selected':'' }}>0km</option>
            <option value="1-100" {{ $request['mileageAmount']=='1-100'?'selected':'' }}>1-100km</option>
            <option value="100-1000" {{ $request['mileageAmount']=='100-1000'?'selected':'' }}>100-1,000km</option>
            <option value="1000-5000" {{ $request['mileageAmount']=='1000-5000'?'selected':'' }}>1,000-5,000km</option>
            <option value="5000-10000" {{ $request['mileageAmount']=='5000-10000'?'selected':'' }}>5,000-10,000km</option>
            <option value="10000-50000" {{ $request['mileageAmount']=='10000-50000'?'selected':'' }}>10,000-50,000km</option>
            <option value="50000-100000" {{ $request['mileageAmount']=='50000-100000'?'selected':'' }}>50,000-100,000km</option>
            <option value="100000-200000" {{ $request['mileageAmount']=='100000-200000'?'selected':'' }}>100,000-200,000km</option>
            <option value="200000-300000" {{ $request['mileageAmount']=='200000-300000'?'selected':'' }}>200,000-300,000km</option>
            <option value="300000-400000" {{ $request['mileageAmount']=='300000-400000'?'selected':'' }}>300,000-400,000km</option>
            <option value="400000-500000" {{ $request['mileageAmount']=='400000-500000'?'selected':'' }}>400,000-500,000km</option>
            </select>
        </div>
        </div>
        @elseif($category == 'car-price')
        <div id="{{ $category }}" class="collapse {{ (request('min_price', False) || request('max_price'))?'show':'' }}" aria-labelledby="{{ $category }}">
        <div class="card-body bg-light grid-radio">
            <div class="form-row">
            <div class="col-md-6">
                <select id="min_price" class="form-control" name="min_price" onchange="formSubmit('min_price','no-value')">
                <option value="">доод</option>
                @for($i=100000; $i<=50000000; $i+=100000)
                <option value="{{ $i }}" {{ $request['minPrice']==$i?'selected':'' }}>{{ numerizePrice($i) }}</option>
                @endfor
                </select>
            </div>
            <div class="col-md-6">
                <select id="max_price" class="form-control" name="max_price" onchange="formSubmit('max_price','no-value')">
                <option value="">дээд</option>
                @for($i=$request['minPrice']?$request['minPrice']:100000; $i<=50000000; $i+=100000)
                <option value="{{ $i }}" {{ $request['maxPrice']==$i?'selected':'' }}>{{ numerizePrice($i) }}</option>
                @endfor
                </select>
            </div>
            </div>
        </div>
        </div>
        @elseif($category == 'car-options')
        <div id="{{ $category }}" class="collapse {{ request($category, False)?'show':'' }}" aria-labelledby="{{ $category }}">
        <div class="card-body bg-light" style="overflow: auto; height: auto">
            @foreach(App\TermTaxonomy::where('taxonomy', $category)->get() as $taxonomy_parent)
            @foreach($taxonomy_parent->children as $taxonomy)
                <div class="custom-control custom-radio">
                <input type="checkbox" id="{{ $taxonomy->term->name }}" name="{{ $category }}[]" class="custom-control-input" value="{{ $taxonomy->term->metaValue('metaKey') }}" {{ in_array($taxonomy->term->metaValue('metaKey'), request($category, []))?'checked':'' }}>
                <label class="custom-control-label  d-flex justify-content-between" for="{{ $taxonomy->term->name }}">{{ $taxonomy->term->name }}
                </label>
                </div>
            @endforeach
            @endforeach
        </div>
        <div class="apply-filter bg-light text-center p-2 border-top">
            <button class="btn btn-round btn-primary btn-sm px-3 mx-auto" onclick="submitMenu()">Шүүх</button>
        </div>
        </div>
        @else
        <div id="{{ $category }}" class="collapse {{ request($category, False)?'show':'' }}" aria-labelledby="{{ $category }}">
        <div class="card-body bg-light">
            @foreach(App\TermTaxonomy::where('taxonomy', $category)->get() as $taxonomy)
            <div class="custom-control custom-radio">
            <!-- <a href="/car-list?{{ $category . '=' . $taxonomy->term->name }}" class="text-body text-decoration-none"> -->
            <input type="radio" id="{{$taxonomy->term->name}}" name="{{ $category }}" class="custom-control-input" value="{{ $taxonomy->term->name }}" {{ ($taxonomy->term->name == request($category, Null))?'checked':'' }}>
            <label class="custom-control-label  d-flex justify-content-between" for="{{$taxonomy->term->name}}">{{ ucfirst($taxonomy->term->name) }}
            </label>
            </div>
            @endforeach
        </div>
        </div>
        @endif
    </div>
    @endforeach

</div>

@push('modals')
@include('themes.car-web.includes.loader')
<!-- <div class="spinner-border" id="demo-spinner" role="status" style="position: fixed; z-index: 1000; top: 50%; left: 50%; display: none">
  <span class="sr-only">Loading...</span>
</div> -->
@endpush

@push('scripts')
<script>
$("input[type=radio][name!=\"car-manufacturer\"]").click(submitMenu);
// $("input[type=checkbox]").click(submitMenu);
$("input[type=radio][name!='car-manufacturer'], .page-link, .advantage-item, .sort-cars li").click(load);

function load(event) {
    $("#demo-spinner").css('display', 'block');
}

function submitMenu(event) {
    event.preventDefault();
    if (event.target.defaultChecked) {
      event.target.checked = false;
    }
    $('#mainForm').submit();
}

var waiting = 0;

$(document).ready(function() {
    @if(request('car-model', Null))
    $("#{{ request('car-manufacturer', 'no-id') }}").trigger('click');
    @endif
    console.log("Yadf");
});

$("input.car-manufacturer").on("click", function () {
    if (waiting == 0) {
        let val = $(this).val();
        console.log(val);
        let subList = $(".car-filter .models[name=\"" + val + "\"");

        if (subList.length) {
            console.log("got it");
            switchToModel(val);
        } else {
            waiting = 1;
            load();
            $.ajax({
                type: 'Get',
                url: '/api/v1/taxonomies/car-' + toKebabCase(val),
            }).done(function(data) {
                $("#demo-spinner").css({'display': 'none'});
                var modelList=data;
                console.log(modelList);
                var html = '<div class="models" name="'+val+'"> \
                <div class="models-back" style="cursor:pointer"><i class="fab fa fa-angle-left"></i> буцах</div> ';

                for (var i = 0; i < modelList.data.length; i++) {
                    let termname = modelList.data[i].term.name;
                    let checked = (termname == '{{ $request['modelName'] }}')?'checked':'';
                    html = html + '<div class="custom-control custom-radio"> '+ 
                        '<input type="radio" id="' + termname + '" name="car-model" value="' + termname + '" class="custom-control-input" '+checked+'> '+
                        '<label class="custom-control-label d-flex justify-content-between" for="' + termname + '">' + termname + '</label></div>';
                }

                html += '</div>';
                $('#manufacturerBody').append(html);
                switchToModel(val);
                $("input[type=radio][name=\"car-model\"]").click(submitMenu);
                $("input[type=radio][name=\"car-model\"]").click(load);
                waiting = 0;
            }).fail(function(err) {
                $("#demo-spinner").css({'display': 'none'});
                console.error("FAIL!");
                console.error(err);
                waiting = 0;
            });
        }
    }
});

function switchToModel(val) {
    $(".car-filter .models.active").hide();
    var subList = $(".car-filter .models[name=\"" + val + "\"");
    if (subList.length) {
        $('.car-filter .manufacturer').hide(300);
        subList.show(300);
        $('.models-back').on('click', function () {
            subList.hide(300);
            $('.car-filter .manufacturer').show(300);
        })
    }
}
</script>
@endpush