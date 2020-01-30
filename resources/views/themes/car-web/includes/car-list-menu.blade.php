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
        <div class="card-body bg-light grid-radio pt-0 pb-0">
            <select id="truck-choice" class="form-control mb-3 type-choice" name="truck-size" onchange="formSubmit('carSubType','no-value')" @if($request['carType']!='Хүнд ММ') style="display: none" @endif>
            <option value="">Хэмжээ сонгох</option>
            @foreach(App\TermTaxonomy::where('taxonomy', 'truck-size')->get() as $taxonomy)
            <option value="{{$taxonomy->term->id}}" {{ ($request['carSubType']==$taxonomy->term->id)?'selected':'' }}>{{ $taxonomy->term->name }}</option>
            @endforeach
            </select>
            <select id="bus-choice" class="form-control mb-3 type-choice" name="bus-size" onchange="formSubmit('carSubType','no-value')" @if($request['carType']!='Автобус') style="display: none" @endif>
            <option value="">Хэмжээ сонгох</option>
            @foreach(App\TermTaxonomy::where('taxonomy', 'bus-sizes')->get() as $taxonomy)
            <option value="{{$taxonomy->term->id}}" {{ ($request['carSubType']==$taxonomy->term->id)?'selected':'' }}>{{ $taxonomy->term->name }}</option>
            @endforeach
            </select>
            <select id="special-choice" class="form-control mb-3 type-choice" name="special" onchange="formSubmit('carSubType','no-value')" @if($request['carType']!='Тусгай ММ') style="display: none" @endif>
            <option value="">Төрөл сонгох</option>
            @foreach(App\TermTaxonomy::where('taxonomy', 'special')->get() as $taxonomy)
            <option value="{{$taxonomy->term->id}}" {{ ($request['carSubType']==$taxonomy->term->id)?'selected':'' }}>{{ $taxonomy->term->name }}</option>
            @endforeach
            </select>
        </div>
        </div>
        @elseif($category == 'car-manufacturer')
        <div id="{{ $category }}" class="collapse {{ request($category, False)?'show':'' }}" aria-labelledby="{{ $category }}">
        <div id="manufacturerBody" class="card-body bg-light">
            <div class="manufacturer">
                @foreach(App\Entities\TaxonomyManager::getManufacturers('normal') as $taxonomy)
                <div class="custom-control custom-radio">
                    <!-- <a href="/car-list?{{ $category . '=' . $taxonomy->term->name }}" class="text-body text-decoration-none"> -->
                    <input type="radio" id="{{$taxonomy->term->id}}" name="{{ $category }}" class="custom-control-input car-manufacturer" value="{{ $taxonomy->term->id }}" placeholder="{{$taxonomy->term->name}}" {{ ($taxonomy->term->id == request($category, Null))?'checked':'' }}>
                    <label class="custom-control-label  d-flex justify-content-between" for="{{$taxonomy->term->id}}">{{ $taxonomy->term->name }}
                    </label>
                </div>
                @endforeach
            </div>
            @if(request('car-model', Null))
            <div class="models" name="{{ request('car-manufacturer', 'no-id') }}" style="display: none">
                <div class="models-back" style="cursor:pointer"><i class="fab fa fa-angle-left"></i> буцах</div> 
                @foreach(App\TermTaxonomy::where('parent_id', request('car-manufacturer', Null))->where('count', '!=', 0)->get() as $taxonomy)
                <div class="custom-control custom-radio">
                    <input type="radio" id="{{$taxonomy->term->name}}" name="car-model" class="custom-control-input" value="{{ $taxonomy->term->id }}" {{ ($taxonomy->term->id == request('car-model', Null))?'checked':'' }}>
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
            <div class="form-row">
            <div class="col-md-6">
                <select id="min-year" class="form-control" name="buildYear" onchange="formSubmit('buildYear','no-value')">
                <option value="">Үйлдвэрлэсэн Он</option>
                @for($i=date('Y'); $i>=1990; $i--)
                <option value="{{ $i }}" {{ $request['buildYear']==$i?'selected':'' }}>{{ $i }}</option>
                @endfor
                </select>
            </div>
            <div class="col-md-6">
                <select id="max-year" class="form-control" name="importDate" onchange="formSubmit('importDate','no-value')">
                <option value="">Орж ирсэн он</option>
                @for($i=date('Y'); $i>=($request['buildYear']?$request['buildYear']:1990); $i--)
                <option value="{{ $i }}" {{ $request['importDate']==$i?'selected':'' }}>{{ $i }}</option>
                @endfor
                </select>
            </div>
            </div>
        </div>
        </div>
        @elseif($category == 'car-distance-driven')
        <div id="{{ $category }}" class="collapse {{ request('mileageAmount', False)?'show':'' }}" aria-labelledby="{{ $category }}">
        <div class="card-body bg-light grid-radio">
            <select id="mileageAmount" class="form-control" name="mileageAmount" onchange="formSubmit('mileageAmount','no-value')">
            <option value="">Явсан КМ сонгох</option>
            @for($i=0; $i < 500000; $i+=10000)
            <option value="{{$i}}-{{$i+10000}}" {{ $request['mileageAmount']==$i.'-'.($i+10000)?'selected':'' }}>{{number_format($i)}}-{{number_format($i+10000)}}km</option>
            @endfor
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
                @for($i=1000000; $i<=500000000; $i+=1000000)
                <option value="{{ $i }}" {{ $request['minPrice']==$i?'selected':'' }}>{{ numerizePrice($i) }}</option>
                @endfor
                </select>
            </div>
            <div class="col-md-6">
                <select id="max_price" class="form-control" name="max_price" onchange="formSubmit('max_price','no-value')">
                <option value="">дээд</option>
                @for($i=$request['minPrice']?$request['minPrice']:1000000; $i<=500000000; $i+=1000000)
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
        @elseif($category == 'car-doctor-verified')
        <div id="{{ $category }}" class="collapse {{ request('mileageAmount', False)?'show':'' }}" aria-labelledby="{{ $category }}">
        <div class="card-body bg-light grid-radio">
            <div class="custom-control custom-radio">
                <input type="radio" id="doctorVerified" name="car-doctor-verified" class="custom-control-input" value="1" {{ ($request['doctorVerified'] == 1)?'checked':'' }}>
                <label class="custom-control-label  d-flex justify-content-between" for="doctorVerified">Баталгаажсан
                </label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" id="doctorVerifiedNo" name="car-doctor-verified" class="custom-control-input" value="0" {{ ($request['doctorVerified'] == 0)?'checked':'' }}>
                <label class="custom-control-label  d-flex justify-content-between" for="doctorVerifiedNo">Баталгаажаагүй
                </label>
            </div>
        </div>
        </div>
        @else
        <div id="{{ $category }}" class="collapse {{ request($category, False)?'show':'' }}" aria-labelledby="{{ $category }}">
        <div class="card-body bg-light">
            @foreach(App\TermTaxonomy::where('taxonomy', $category)->get() as $taxonomy)
            <div class="custom-control custom-radio">
            <!-- <a href="/car-list?{{ $category . '=' . $taxonomy->term->name }}" class="text-body text-decoration-none"> -->
            <input type="radio" id="{{$taxonomy->term->name}}" name="{{ $category }}" class="custom-control-input" value="{{ $taxonomy->term->id }}" {{ ($taxonomy->term->id == request($category, Null))?'checked':'' }}>
            <label class="custom-control-label  d-flex justify-content-between" for="{{$taxonomy->term->name}}">{{ ucfirst($taxonomy->term->name) }}
                {{$taxonomy->count}}
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
$("input[type=radio][name!='car-manufacturer'][name!='car-type']").click(submitMenu);
// $("input[type=checkbox]").click(submitMenu);
$("input[type=radio][name!='car-manufacturer'][name!='car-type'], .page-link, .advantage-item, .sort-cars li").click(load);

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
});

$("input[name='car-type']").on("click", function() {
    if (waiting == 0) {
        let val = $(this).val();
        if (val == "Автобус") {
            val = "bus";
        } else if (val == "Хүнд ММ") {
            val = "truck";
        } else if (val == "Тусгай ММ") {
            val = "special";
        } else {
            val = 'normal';
        }
        $(".type-choice").hide(300);
        $("#"+val+"-choice").show(300);

        waiting = 1;
        load();
        $.ajax({
            type: 'Get',
            url: '/api/v1/taxonomies/car-manufacturer?type=' + val,
        }).done(function(data) {
            $("#demo-spinner").css({'display': 'none'});
            $(".manufacturer").empty();
            var modelList=data;

            var html = '';
            for (var i = 0; i < modelList.data.length; i++) {
                let termname = modelList.data[i].term.name;
                let termid = modelList.data[i].term.id;
                let checked = (termid == '{{ $request['markName'] }}')?'checked':'';

                html = '<div class="custom-control custom-radio">' +
                    '<input type="radio" id="'+termid+'" name="{{ $category }}" class="custom-control-input car-manufacturer" value="'+termid+'"' +checked+ ' placeholder="'+termname+'">'+
                    '<label class="custom-control-label  d-flex justify-content-between" for="'+termid+'">'+termname+'</label>';
                $(".manufacturer").append(html);
            }
            switchToManufacturer();
            //switchToModel(val);

            $("input.car-manufacturer").on("click", onManufacturerSelect);
            //$("input[type=radio][name=\"car-model\"]").click(submitMenu);
            //$("input[type=radio][name=\"car-model\"]").click(load);
            waiting = 0;
        }).fail(function(err) {
            $("#demo-spinner").css({'display': 'none'});
            console.error("FAIL!");
            console.error(err);
            waiting = 0;
        });
    }
});

$("input.car-manufacturer").on("click", onManufacturerSelect);

function onManufacturerSelect() {
    if (waiting == 0) {
        // let val = $(this).val();
        let val = $(this).attr("placeholder");
        console.log(val);
        let subList = $(".car-filter .models[name=\"" + val + "\"");

        if (subList.length) {
            switchToModel(val);
        } else {
            waiting = 1;
            load();
            $.ajax({
                type: 'Get',
                url: '/api/v1/taxonomies/car-' + toKebabCase(val) + '?count=1',
            }).done(function(data) {
                $("#demo-spinner").css({'display': 'none'});
                var modelList=data;
                var html = '<div class="models" name="'+val+'"> \
                <div class="models-back" style="cursor:pointer"><i class="fab fa fa-angle-left"></i> буцах</div> ';

                for (var i = 0; i < modelList.data.length; i++) {
                    let termname = modelList.data[i].term.name;
                    let termid = modelList.data[i].term.id;
                    let checked = (termid == '{{ $request['modelName'] }}')?'checked':'';
                    html = html + '<div class="custom-control custom-radio"> '+ 
                        '<input type="radio" id="' + termname + '" name="car-model" value="' + termid + '" class="custom-control-input" '+checked+'> '+
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
}

function switchToManufacturer() {
    $('.car-filter .models').hide(300);
    $('.car-filter .manufacturer').show(300);
}

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