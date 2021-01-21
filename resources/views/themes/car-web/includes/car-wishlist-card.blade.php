<!-- @if($car)
    <div class="card cd-box">
        <div class="card-top">
            <h2 class="title truncate" title="{{$car->title}}">{{$car->title}}</h1>
        </div>
        <div class="card-body py-2">
            <div class="wish-detail">
                <div class="price"><i class="icon-tag"></i>{{ numerizePrice($car->metaValue('priceAmountStart')) }} - {{ numerizePrice($car->metaValue('priceAmountEnd')) }} {{ $car->metaValue('priceUnit') }}</div>
                <div class="phone">
                    <i class="icon-phone"></i><span id="phone{{$car->id}}">{{ str_limit($car->author->metaValue('phone'), 9) }}</span>
                    <button id="watchBtn{{$car->id}}" class="btn btn-sm btn-outline-dark float-right" type="button" onclick="watchPhone('{{$car->id}}', '{{$car->author->metaValue('phone')}}')">Watch</button>
                </div>
            </div>
            <div class="wish-user">
                <div class="profile-img"><img src="{{ $car->author->avatar_url() }}" alt=""></div>
                <div class="username truncate">
                    {{ $car->author->name }}
                    <div class="date">{{ getDateFromDatetime($car->created_at) }}</div>
                </div>
            </div>
        </div>
    </div>
@endif -->
@if($car)

    <div class="wish-card cd-box">
    <div class="card-body">
        <h2 class="title" title="{{$car->title}}">
        {{$car->title}} авна</h2>
        <div class="wish-detail">
        <div class="price">{{ numerizePrice($car->metaValue('priceAmountStart')) }} ~ {{ numerizePrice($car->metaValue('priceAmountEnd')) }} {{ $car->metaValue('priceUnit') }}</div>
        </div>
        <div class="wish-user">
        <div class="user">
            <div class="profile-img"><img src="{{ $car->author->avatar_url() }}" alt=""></div>
            <div class="username">{{ $car->author->name }} <div class="date">{{ getDateFromDatetime($car->created_at) }}</div>
        </div>
        </div>
        <div class="phone"><span id="phone{{$car->id}}">{{ str_limit($car->author->metaValue('phone'), 4) }}</span>
        <button id="watchBtn{{$car->id}}" class="btn btn-sm btn-outline-dark float-right" type="button" onclick="watchPhone('{{$car->id}}', '{{$car->author->metaValue('phone')}}')">Дугаар харах</button></div>

        </div>

    </div>
    <div class="bg-img"> 
    <!-- <img src="https://loremflickr.com/415/350/{{$car->title}}" alt=""> -->
    </div>
    </div>

@endif
