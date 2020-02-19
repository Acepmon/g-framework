@if($car)
<div class="card {{ (isset($type) && $type == 'auction')?'auction-car':'' }} {{ isset($noborder)?'border-0':'' }}">
    <div class="card-body">
        <a class="card-img" href="{{ $car->slug }}" target="_blank">
            @if(isPremium($car))
            <div class="premium-tag shadow-soft-blue"><img src="{{ asset('car-web/img/icons/corona.svg') }}" alt=""></div>
            @endif
            @if(getMetasValue($car->metas, 'doctorVerified')==1)
            <div class="doctor-verified-tag shadow-soft-blue"><img src="{{ asset('car-web/img/cardoctor.png') }}" alt=""></div>
            @endif
            @if(isset($type) && $type == 'auction' && $car->metaValue('isAuction'))
            <div class="maz-auction-time">
                <div id="countdown" class="countdown" data-countdown="{{ $car->metaValue('endsAt') }}"></div>
                <!-- may 5, 2020 15:37:25 -->
            </div>
            @endif
            <img src="{{ (substr($car->metaValue('thumbnail'), 0, 4) !== 'http')?(App\Config::getStorage() . $car->metaValue('thumbnail')):$car->metaValue('thumbnail') }}" class="img-fluid" alt="alt">
        </a>
        <div class="card-description">
            <div class="card-caption">
                <a href="{{ $car->slug }}" target="_blank">
                    <div class="card-title">{{ (strlen($car->title) > 40)?substr($car->title, 0, 37) . '...':$car->title }}</div>
                    <div class="meta">{{ $car->metaValue('buildYear') }}/{{ $car->metaValue('importDate') }} | {{ $car->metaValue('mileageAmount') }} {{ $car->metaValue('mileageUnit') }}</div>
                    <div class="price">{{ numerizePrice($car->metaValue('priceAmount')) }} {{ $car->metaValue('priceUnit') }}</div>
                </a>

                @if(isset($type) && $type=='my-page')
                    @if(\App\PaymentTransaction::where('content_id', $car->id)->count() > 0)
                    <div class="is-premium font-weight-normal text-danger">Шалгагдаж байна</div>
                    @else
                    <button class="btn btn-warning btn-round shadow-soft-blue btn-icon-left px-3 btn-sm mr-5 mt-2" data-toggle="modal" onclick="transferId({{$onSale->id}})" data-target="#premiumAd" href="#"> Make premium ad</button>
                    @endif
                @elseif(Auth::user() && $car->author_id == Auth::user()->id)
                <div class="favorite">
                    <span class=""><i class="fas fa-car"></i> Энэ таны машин</span>
                </div>
                @else
                    @if(Auth::check() && Auth::user()->hasMeta('interestedCars', $car->id))
                    <div class="favorite" onclick="addToInterest(event, {{$car->id}})">
                        <span class="text-danger"><i class="fas fa-heart"></i> Жагсаалтанд нэмэгдсэн</span>
                    </div>
                    @else
                    <div class="favorite" onclick="addToInterest(event, {{$car->id}})">
                        <span class=""><i class="far fa-heart"></i> Жагсаалтанд нэмэх</span>
                    </div>
                    @endif
                @endif
            </div>
            <div class="info">
                @if($car->metaValue('capacityAmount')!=null)
                <span class="info-icon">
                    <img src="{{ asset('car-web/img/icons/engine.svg') }}" alt="">
                    @if((getMetasValue($car->metas, 'doctorVerified'))===1)
                    <div class="doctor-verified-tag shadow-soft-blue"><img src="{{ asset('car-web/img/cardoctor.png') }}" alt=""></div>
                    @endIf
                    <p>{{ ucfirst($car->metaValue('capacityAmount')) . ' ' . strtoupper($car->metaValue('capacityUnit')) }}</p>
                </span>
                @endif
                @if($car->metaValue('wheelPosition')!=null)
                <span class="info-icon">
                    <img src="{{ asset('car-web/img/icons/wheel.svg') }}" alt="">
                    <p>{{ ucfirst($car->metaValue('wheelPosition')) }}</p>
                </span>
                @endif
                @if($car->metaValue('transmission')!=null)
                <span class="info-icon">
                    <img src="{{ asset('car-web/img/icons/gearShift.svg') }}" alt="">
                    <p>{{ ucfirst($car->metaValue('transmission')) }}</p>
                </span>
                @endif
                @if($car->metaValue('fuelType')!=null)
                <span class="info-icon">
                    <img src="{{ asset('car-web/img/icons/fuel.svg') }}" alt="">
                    <p>{{ ucfirst($car->metaValue('fuelType')) }} </p>
                </span>
                @endif
                @if($car->metaValue('axleCount')!=null)
                <span class="info-icon">
                    <img src="{{ asset('car-web/img/icons/transmision.svg') }}" alt="">
                    <p>{{ $car->metaValue('axleCount') }} WD</p>
                </span>
                @endif
                @if(\App\Term::where('name', $car->metaValue('colorName'))->first())
                <span class="info-icon color" data-color="{{ strtolower(\App\Term::where('name', $car->metaValue('colorName'))->first()->metaValue('value')) }}">
                    <p>{{ ucfirst($car->metaValue('colorName')) }}</p>
                </span>
                @endif

                @if(isset($type) && $type=='my-page')
                <div class="sell-action">
                    <div onclick="window.open('/edit?id={{$car->id}}');">Засах</div>
                    <div data-toggle="modal" data-target="#deteleCont" onclick="contsId({{$car->id}})">Устгах</div>
                    <div data-toggle="modal" data-target="#markCont" onclick="contsId({{$car->id}})">Зарагдсан</div>
                    <div data-toggle="modal" data-target="#publishCont" onclick="contsId({{$car->id}})">Идэвхгүй</div>
                </div>
                @else
                <div class="advantage-slider owl-carousel owl-theme">
                    @foreach($car->metas->where('key', 'advantages') as $advantage)
                    <a class="advantage-item" onclick="addAdvantage('{{$advantage->value}}')">{{ $advantage->value }}</a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
