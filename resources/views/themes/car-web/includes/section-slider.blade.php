@if($contents && count($contents) > 0)
<section class="section card-list my-5">
    <div class="container">
        <div class="row">
            <div class="section-title">
                <h2>{{ $title }}</h2>
                <span>
                    <a href="{{ $morelink }}">Бүгдийг харах ({{ count($contents) }}) <i class="fab fa fa-angle-right"></i></a>
                </span>
            </div>
            <div class="card-slide owl-carousel owl-theme">
                @foreach($contents->take(12) as $car)
                <a href="/{{ $car->slug }}" class="card cd-box">
                    @if($car->metaValue('publishType') == 'best_premium' || $car->metaValue('publishType') == 'premium')
                    <div class="premium-tag shadow-soft-blue"><img src="{{ asset('car-web/img/icons/corona.svg') }}" alt=""></div>
                    @endif
                    <div class="card-img">
                        <img src="{{ (substr($car->metaValue('thumbnail'), 0, 4) !== 'http')?(App\Config::getStorage() . $car->metaValue('thumbnail')):$car->metaValue('thumbnail') }}" class="img-fluid" alt="alt">

                        <div class="card-caption">
                            <div class="meta">{{ number_format($car->metaValue('mileageAmount')) }} {{ $car->metaValue('mileageUnit') }} | {{ ucfirst($car->metaValue('fuelType')) }} | {{ $car->metaValue('capacityAmount') }} {{ $car->metaValue('capacityUnit') }}</div>
                        </div>
                    </div>

                    <div class="card-body py-2">
                        <div class="card-description">
                            <div class="card-desc-top">
                                <div class="card-title">{{ $car->title }}</div>
                                @if(Auth::user() && $car->author_id==Auth::user()->id)
                                    <div class="favorite">
                                        <span class="text-dark"><i class="fas fa-car"></i></span>
                                    </div>
                                @else
                                    @if(Auth::user() && count(metaHas(Auth::user(), 'interestedCars', $car->id)->get()) > 0)
                                    <div class="favorite" onclick="addToInterestFromSlider(event, {{$car->id}})">
                                        <span class="text-danger"><i class="fas fa-heart"></i></span>
                                    </div>
                                    @else
                                    <div class="favorite" onclick="addToInterestFromSlider(event, {{$car->id}})">
                                        <span class="text-danger"><i class="far fa-heart"></i></span>
                                    </div>
                                    @endif
                                @endif
                                <div class="price" style="min-width: 35%">{{ numerizePrice($car->metaValue('priceAmount')) }} {{ $car->metaValue('priceUnit') }}</div>
                            </div>

                            <div class="card-meta">
                                <div class="year">{{ $car->metaValue('buildYear') }}/{{ $car->metaValue('importDate') }}</div>
                            </div>
                            <div class="status">{{ ucfirst($car->metaValue('priceType')) }}</div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
.card-list .owl-stage {
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;

    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}
/* .card-list .owl-item {
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    height: auto !important;
} */
</style>
@endif

@push('scripts')
<script>
function addToInterestFromSlider(event, value) {
    event.preventDefault();
    event.stopPropagation();
    var target = event.target.closest('div');
    // target.innerHTML = 'Loading';

    $.ajax({
      url: '/ajax/user/interested_cars', 
      dataType: 'json',
      method: 'PUT',
      data: {
          'content_id': value
      },
      success: function (data) {
        if (data.status == 'added') {
          target.innerHTML = '<span class="text-danger"><i class="fas fa-heart"></i></span>';
        } else if (data.status == 'removed') {
          target.innerHTML = '<span class="text-danger"><i class="far fa-heart"></i></span>';
        }
      },
      error: function (error) {
        if (error.status == 401) {
          window.location.href = "{{ route('login') }}";
        }
      }
    });
}
</script>
@endpush
