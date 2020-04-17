@if(isset($showAll) && $showAll)
<div class="custom-control custom-radio">
<input type="radio" id="{{$name}}-all" name="{{ $name }}" class="custom-control-input" value="" checked>
<label class="custom-control-label  d-flex justify-content-between" for="{{$name}}-all">Бүгд
    <div class="text-muted" id="{{$name}}-count" ></div>
</label>
</div>
@endif

@if(isset($container))
<div class="{{ $container }}" name="{{ $name }}-container">
    @if($container == 'models')
    <div class="models-back" style="cursor:pointer" onclick="hideSubList('.car-filter .models[name=\'{{ $name }}\']', '.car-filter .manufacturer')">
        <i class="fab fa fa-angle-left"></i> буцах
    </div>
    @endif
@endif

@foreach($taxonomies as $taxonomy)
<div class="custom-control custom-radio {{ ($taxonomy->contents_count==0)?'none':'' }}">
<input type="radio" id="{{$taxonomy->id}}" name="{{ $name }}" class="custom-control-input {{ $taxonomy->taxonomy }}" value="{{ $taxonomy->term->id }}"
    placeholder="{{ $taxonomy->term->name }}" {{ ($taxonomy->term->id == request($name, Null) || $taxonomy->term->id == request('car-model', Null))?'checked':'' }}>
<label class="custom-control-label  d-flex justify-content-between" for="{{$taxonomy->id}}">{{ ucfirst($taxonomy->term->name) }}
    <div class="text-muted" id="{{$taxonomy->id}}-count">
        {{ $taxonomy->contents_count }}
    </div>
</label>
</div>
@endforeach

@if(isset($container))
</div>
@endif
