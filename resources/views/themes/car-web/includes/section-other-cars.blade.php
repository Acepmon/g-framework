<section class="mainPage-items bg-light homeFreeCars">
    <div class="container">

        <div class="row">
            <div class="section-title">
                <h2>Бусад машинууд</h2>
                <span>
                    @contentInline(type=car, status=published, limit=10, sort=publishedAt as $othCarsTotal | paginate)
            <a href="/buy">Бүгдийг харах ( {{ $othCarsTotal->total() }} ) <i class="fab fa fa-angle-right"></i></a>
          </span>
            </div>
            <div class="car-list">
                <div class="row">
                    @foreach($othCarsTotal as $othCars)
                    @if(count($interestedCars) > 0)
                        @foreach($interestedCars as $intCars)
                            @if($intCars==$othCars->id)
                                @php
                                    $itsIntCar=true;
                                @endphp
                                @break;
                            @else
                                @php
                                    $itsIntCar=false;
                                @endphp
                            @endif
                        @endforeach
                    @else
                        @php
                            $itsIntCar=false;
                        @endphp
                    @endif
                        <div class="col-lg-6 col-md-6">
                            <!-- card start -->
                            <a href="{{$othCars->slug}}" target="_blank" class="card">
                                <div class="card-body">
                                    <div class="card-img">
                                    @if(getMetasValue($othCars->metas, 'doctorVerified')==1)
                                    <div class="doctor-verified-tag shadow-soft-blue"><img src="{{ asset('car-web/img/cardoctor-logo.svg') }}" alt=""></div>
                                    @endif
                                        <img src="{{ $othCars->thumbnail() }}" class="img-fluid" alt="alt">
                                    </div>
                                    <div class="card-description">
                                        <div class="card-caption">
                                            <div class="card-title">{{$othCars->title}}</div>
                                            <div class="meta">{{(getMetasValue($othCars->metas,'buildYear'))}} / {{(getMetasValue($othCars->metas,'importDate'))}} | {{ number_format(getMetasValue($othCars->metas,'mileageAmount'))}} {{(getMetasValue($othCars->metas,'mileageUnit'))}}</div>
                                            <div class="price">{{numerizePrice((getMetasValue($othCars->metas,'priceAmount')))}} {{(getMetasValue($othCars->metas, 'priceUnit'))}}</div>
                                            @if(Auth::user()!=null && $othCars->author_id==Auth::user()->id)
                                                <div class="favorite">
                                                    <span class=""><i class="fas fa-car"></i> This is your car</span>
                                                </div>
                                            @else
                                                <div class="favorite saveToInterested" data-target="{{ $othCars->id }}">
                                                    @if($itsIntCar==true)
                                                        <span class="text-danger"><i class="fas fa-heart"></i></span>
                                                    @else
                                                        <span class="text-danger"><i class="icon-heart"></i></span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- card end -->
                    @endforeach 

                </div>
                <div class="row">
                    <a class="btn btn-danger btn-round shadow-red mx-auto my-3 px-5" href="/buy">Бүх машинууд</a>
                </div>
            </div>
        </div>
    </div>
</section>

