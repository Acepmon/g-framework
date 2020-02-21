@php
$categorySlug = [
'car-type', 'car-manufacturer', 'car-build-year','car-import-year', 'car-distance-driven', 'car-price', 'car-colors', 'car-fuel', 'car-transmission',
'car-options', 'car-mancount', 'car-wheel-pos', 'provinces', 'car-seller', 'car-doctor-verified'
];
$categoryName = [
'Төрөл', 'Үйлдвэрлэгч/Модел', 'Үйлдвэрлэсэн он', 'Орж ирсэн он', 'Явсан КМ', 'Үнэ', 'Өнгө', 'Шатахуун', 'Араа',
'Option', 'Зорчигч', 'Жолоо', 'Байршил', 'Борлуулагч', 'Doctor баталгаажсан'
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
            <input type="radio" id="{{ $taxonomy->term->metaValue('value') }}" name="{{ $category }}" class="custom-control-input" value="{{ $taxonomy->term->id }}" >
            <label class="custom-control-label " for="{{ $taxonomy->term->metaValue('value') }}">
                <img src="{{ asset('car-web/img/icons/'.strtolower($taxonomy->term->metaValue('value')).'.svg') }}">
                <span>{{ $taxonomy->term->name }}</span>
            </label>
            </div>
            @endforeach
        </div>
        <div class="card-body bg-light grid-radio pt-0 pb-0">
            <select id="truck-choice" class="form-control mb-3 type-choice" name="truck-size" onchange="formSubmit('carSubType','no-value')" style="display: none">
            <option value="">Хэмжээ сонгох</option>
            @foreach(App\TermTaxonomy::where('taxonomy', 'truck-size')->get() as $taxonomy)
            <option value="{{$taxonomy->term->id}}" {{ (request('carSubType')==$taxonomy->term->id)?'selected':'' }}>{{ $taxonomy->term->name }}</option>
            @endforeach
            </select>
            <select id="bus-choice" class="form-control mb-3 type-choice" name="bus-size" onchange="formSubmit('carSubType','no-value')"  style="display: none">
            <option value="">Хэмжээ сонгох</option>
            @foreach(App\TermTaxonomy::where('taxonomy', 'bus-sizes')->get() as $taxonomy)
            <option value="{{$taxonomy->term->id}}" {{ (request('carSubType')==$taxonomy->term->id)?'selected':'' }}>{{ $taxonomy->term->name }}</option>
            @endforeach
            </select>
            <select id="special-choice" class="form-control mb-3 type-choice" name="special" onchange="formSubmit('carSubType','no-value')"  style="display: none">
            <option value="">Төрөл сонгох</option>
            @foreach(App\TermTaxonomy::where('taxonomy', 'special')->get() as $taxonomy)
            <option value="{{$taxonomy->term->id}}" {{ (request('carSubType')==$taxonomy->term->id)?'selected':'' }}>{{ $taxonomy->term->name }}</option>
            @endforeach
            </select>
        </div>
        </div>
        @elseif($category == 'car-manufacturer')
        <div id="{{ $category }}" class="collapse {{ request($category, False)?'show':'' }}" aria-labelledby="{{ $category }}">
        <div id="manufacturerBody" class="card-body bg-light">
            <div class="manufacturer">
                <input type="hidden" name="car-manufacturer" value="{{request('car-manufacturer', Null)}}"/>
                <input type="hidden" name="car-model" value="{{request('car-model', Null)}}"/>
            </div>
        </div>
        </div>
        @elseif($category == 'car-build-year')
        <div id="{{ $category }}" class="collapse" aria-labelledby="{{ $category }}">
        <div class="card-body bg-light grid-radio">
            <div class="form-row">
            <div class="col-md-6">
                <select id="minBuildYear" class="form-control" name="minBuildYear" onchange="minChoose('BuildYear','no-value')">
                <option value="">Доод</option>
                @for($i=date('Y'); $i>=1990; $i--)
                <option value="{{ $i }}" {{ request('buildYear', null)==$i?'selected':'' }}>{{ $i }}</option>
                @endfor
                </select>
            </div>
            <div class="col-md-6">
                <select id="maxBuildYear" class="form-control" name="maxBuildYear" onchange="formSubmit('maxBuildYear','no-value')">
                <option value="">Дээд</option>
                @for($i=date('Y'); $i>=request('minBuildYear', 1990); $i--)
                <option value="{{ $i }}" {{ request('buildYear', null)==$i?'selected':'' }}>{{ $i }}</option>
                @endfor
                </select>
            </div>
            </div>
        </div>
        </div>
        @elseif($category == 'car-import-year')
        <div id="{{ $category }}" class="collapse" aria-labelledby="{{ $category }}">
        <div class="card-body bg-light grid-radio">
            <div class="form-row">
            <div class="col-md-6">
                <select id="minImportDate" class="form-control" name="minImportDate" onchange="minChoose('ImportDate','no-value')">
                <option value="">Доод</option>
                @for($i=date('Y'); $i>=1990; $i--)
                <option value="{{ $i }}" {{ request('importDate', null)==$i?'selected':'' }}>{{ $i }}</option>
                @endfor
                </select>
            </div>
            <div class="col-md-6">
                <select id="maxImportDate" class="form-control" name="maxImportDate" onchange="formSubmit('maxImportDate','no-value')">
                <option value="">Дээд</option>
                @for($i=date('Y'); $i>=request('minImportDate', 1990); $i--)
                <option value="{{ $i }}" {{ request('importDate', null)==$i?'selected':'' }}>{{ $i }}</option>
                @endfor
                </select>
            </div>
            </div>
        </div>
        </div>
        @elseif($category == 'car-distance-driven')
        <div id="{{ $category }}" class="collapse {{ request('minMileageAmount', False)?'show':'' }}" aria-labelledby="{{ $category }}">
        <div class="card-body bg-light grid-radio">
            <div class="form-row">
                <div class="col-md-6">
                    <select id="minMileageAmount" class="form-control" name="minMileageAmount" onchange="minChoose('MileageAmount','no-value')">
                        <option value="">Эхлэх</option>
                        @for($i=0; $i <= 800000; $i+=10000)
                        <option value="{{$i}}" {{ request('minMileageAmount', -1)==$i? 'selected':'' }}>{{number_format($i)}} km</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-6">
                    <select id="maxMileageAmount" class="form-control" name="maxMileageAmount" onchange="formSubmit('maxMileageAmount','no-value')">
                        <option value="">Дуусах</option>
                        @for($i=0; $i <= 800000; $i+=10000)
                        <option value="{{$i}}" {{ request('maxMileageAmount', -1)==$i? 'selected':'' }}>{{number_format($i)}} km</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        </div>
        @elseif($category == 'car-price')
        <div id="{{ $category }}" class="collapse {{ (request('minPriceAmount', False) || request('max_price'))?'show':'' }}" aria-labelledby="{{ $category }}">
        <div class="card-body bg-light grid-radio">
            <div class="form-row">
            <div class="col-md-6">
                <select id="minPriceAmount" class="form-control" name="minPriceAmount" onchange="minChoose('PriceAmount','no-value')">
                <option value="{{ request('minPriceAmount') }}">Доод</option>
                @for($i=1000000; $i<=500000000; $i+=1000000)
                <option value="{{ $i }}">{{ numerizePrice($i) }}</option>
                @endfor
                </select>
            </div>
            <div class="col-md-6">
                <select id="maxPriceAmount" class="form-control" name="maxPriceAmount" onchange="formSubmit('maxPriceAmount','no-value')">
                <option value="{{ request('maxPriceAmount') }}">Дээд</option>
                @for($i=request('minPriceAmount', Null)?request('minPriceAmount', Null):1000000; $i<=500000000; $i+=1000000)
                <option value="{{ $i }}">{{ numerizePrice($i) }}</option>
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
            <h6>{{$taxonomy_parent->term->name}}</h6>
            @foreach($taxonomy_parent->children as $taxonomy)
                <div class="custom-control custom-radio">
                <input type="checkbox" id="{{ $taxonomy->term->name }}" name="{{ $taxonomy->taxonomy }}[]" class="custom-control-input" value="{{ $taxonomy->term->id }}" {{ in_array($taxonomy->term->metaValue('metaKey'), request($category, []))?'checked':'' }}>
                <label class="custom-control-label  d-flex justify-content-between" for="{{ $taxonomy->term->name }}">{{ $taxonomy->term->name }}
                    <div class="text-muted" id="{{$taxonomy->id}}-count" ></div>
                </label>
                </div>
            @endforeach
            <br>
            @endforeach
        </div>
        <div class="apply-filter bg-light text-center p-2 border-top">
            <button class="btn btn-round btn-primary btn-sm px-3 mx-auto" onclick="submitMenu()">Шүүх</button>
        </div>
        </div>
        @else
        <div id="{{ $category }}" class="collapse {{ request($category, False)?'show':'' }}" aria-labelledby="{{ $category }}">
        <div class="card-body bg-light">
            @include('themes.car-web.includes.car-list-menu-items', [
                'taxonomies' => App\TermTaxonomy::where('taxonomy', $category)->get(),
                'name' => $category,
                'showAll' => ($category == 'car-seller' || $category == 'car-doctor-verified')
                ])
        </div>
        </div>
        @endif
    </div>
    @endforeach
</div>

@push('scripts')
<script>
$("input[type=radio][name!='car-manufacturer']").click(submitMenu);
$("input[type=radio][name!='car-manufacturer'], .page-link, .advantage-item, .sort-cars li").click(load);

function load(event) {
    $("#demo-spinner").css('display', 'block');
}

function submitMenu(event) {
    var target = $(event.target)[0];
    var $prevChecked = $('input[name=' + target.name + ']:not(:checked).checked');
    $prevChecked.removeClass('checked');
    if ($(this).hasClass('checked')) {
        event.target.checked = false;
        $(this).removeClass('checked');
    } else {
        $(this).addClass('checked');
    }
    refilter();
}

var waiting = 0;

$(document).ready(function() {
    callManufacturers('', ()=>{
        @if(request('car-manufacturer', False))
        $("#{{ request('car-manufacturer', 0) }}").trigger('click');
        @endif
    });
    @if(request('car-type', False))
    $("input[name=car-type][value={{ request('car-type', 0) }}]").trigger('click');
    @endif
});

$("input[name='car-type']").on("click", function() {
    if (waiting == 0) {
        let type = $(this).val();
        if (type == {{ \App\Term::where('name', 'Автобус')->first()->id }}) {
            type = "bus";
        } else if (type == {{ \App\Term::where('name', 'Хүнд ММ')->first()->id }}) {
            type = "truck";
        } else if (type == {{ \App\Term::where('name', 'Тусгай ММ')->first()->id }}) {
            type = "special";
        } else {
            type = 'normal';
        }
        $(".type-choice").hide(300);
        $("#"+type+"-choice").show(300);

        waiting = 1;
        load();
        callManufacturers(type, ()=>{});
    }
});

function callManufacturers(type, __callback) {
    var getParams = '&count=True&order=count';
    @if(request('car-manufacturer', False))
    getParams += '&car-manufacturer=' + {{ request('car-manufacturer', 0) }};
    @endif
    $.ajax({
        type: 'Get',
        url: '/ajax/cars/taxonomy/car-manufacturer?type=' + type + getParams
    }).done(function(data) {
        $data = $(data);
        $("#demo-spinner").css({'display': 'none'});
        $("#manufacturerBody .manufacturer").empty();
        $("#manufacturerBody .manufacturer").html(data);
        if (type != '') {
            $("#car-manufacturer").collapse('show');
        }

        switchToManufacturer();

        $("input.car-manufacturer").on("click", onManufacturerSelect);
        //$("input[type=radio][name=\"car-model\"]").click(submitMenu);
        //$("input[type=radio][name=\"car-model\"]").click(load);
        waiting = 0;
        return __callback();
    }).fail(fail);
}

$("input.car-manufacturer").on("click", onManufacturerSelect);

function onManufacturerSelect() {
    var getParams = '?count=False';
    @if(request('car-model', False))
    getParams += '&car-model=' + {{ request('car-model', 0) }};
    @endif
    if (waiting == 0) {
        let val = $(this).attr("placeholder");
        let name = "car-" + toKebabCase(val) + "-container";
        let subList = $(".car-filter .models[name=\"" + name + "\"");

        if (subList.length) {
            switchToModel(name);
        } else {
            waiting = 1;
            load();
            var paramObjs = getParamObjs();
            $.ajax({
                type: 'Get',
                url: '/ajax/cars/taxonomy/car-' + toKebabCase(val) + getParams,
                // data: paramObjs
            }).done(function(data) {
                $("#demo-spinner").css({'display': 'none'});
                $('#manufacturerBody').append($(data));
                switchToModel(name);
                $(".models[name=\""+name+"\"] input[type=radio]").click(function() {
                    $("#manufacturerBody .models input[type=radio][name!=\""+$(this).attr("name")+"\"]").each(function() {
                        $(this).prop('checked', false);
                    });
                });
                $(".models[name=\""+name+"\"] input[type=radio]").click(submitMenu);
                $(".models[name=\""+name+"\"] input[type=radio]").click(load);
                waiting = 0;
            }).fail(fail);
        }
    }
}

function switchToManufacturer() {
    $('.car-filter .models').hide(300);
    $('.car-filter .manufacturer').show(300);
}

function switchToModel(name) {
    $(".car-filter .models.active").hide();
    var subList = $(".car-filter .models[name=\"" + name + "\"");
    if (subList.length) {
        $('.car-filter .car-manufacturer').hide(300);
        subList.show(300);
        $('.models-back').on('click', function () {
            subList.hide(300);
            $('.car-filter .car-manufacturer').show(300);
        })
    }
}

function hideSubList(hideSelector, showSelector) {
    $(hideSelector).hide(300);
    $(showSelector).show(300);
}

function minChoose(name, value) {
    var minValue = $("#min"+name).val();
    $("#max"+name + " option").each(function() {
        if (parseInt(this.value) < parseInt(minValue)) {
            $(this).hide();
        } else {
            $(this).show();
        }
    });
    formSubmit('min'+name, 'no-value');
}

function fail(err) {
    $("#demo-spinner").css({'display': 'none'});
    console.error("FAIL!");
    console.error(err);
    waiting = 0;
}
</script>
@endpush
