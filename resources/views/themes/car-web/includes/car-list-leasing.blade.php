<div class="container">
    <div class="row">
        <div class="card page-top-navbar border-0">
            <div class="d-flex justify-content-start">

                  <span class="total-cars ml-0">НИЙТ {{$cars->total()}}
                  </span>
                  <div class="sort-cars col-md-9">
                      <ul>
                          @if (request('priceAmount', '0') == '0')
                          <li class="active"><a onclick="formSubmit('searchByTotPrice', 0)">Бүгдийг харах</a></li>
                          @else
                          <li><a onclick="formSubmit('searchByTotPrice', 0)">Бүгдийг харах</a></li>
                          @endif
                          @if (request('sort','updated_at')=='updated_at')
                          @if (request('sortDir', 'desc')=='desc')
                          <li class="active"><a
                                  onclick="formSubmit('sortBy', 'updated_at', 'sortDir', 'asc')">Сүүлд нийтлэгдсэн
                                  ▼</a></li>
                          @else
                          <li class="active"><a
                                  onclick="formSubmit('sortBy', 'updated_at', 'sortDir', 'desc')">Өмнө нь нийтлэгдсэн
                                  ▲</a></li>
                          @endif
                          @else
                          <li><a onclick="formSubmit('sortBy', 'updated_at', 'sortDir', 'desc')">Сүүлд
                                  нийтлэгдсэн</a></li>
                          @endif

                          @if (request('sort')=='priceAmount')
                          @if (request('sortDir')=='desc')
                          <li class="active"><a
                                  onclick="formSubmit('sortBy', 'priceAmount', 'sortDir', 'asc')">Хамгийн үнэтэй ▲</a>
                          </li>
                          @else
                          <li class="active"><a
                                  onclick="formSubmit('sortBy', 'priceAmount', 'sortDir', 'desc')">Хямд үнэ ▼</a></li>
                          @endif
                          @else
                          <li><a onclick="formSubmit('sortBy', 'priceAmount', 'sortDir', 'asc')">Хямд үнэ</a>
                          </li>
                          @endif
                      </ul>
                  </div>
            </div>
        </div>

        <div class="card-list pt-3" style="width: 100%">
            <div class="row">

                @foreach($cars as $carDataMonthly)
                <div class="col-lg-3 col-md-4">
                    <!-- card start -->
                    <a href="{{$carDataMonthly->slug}}" target="_blank" class="card cd-box">
                        @if(isPremium($carDataMonthly)=='best_premium')
                        <div class="premium-tag"><img src="{{ asset('car-web/img/icons/best-mark.svg') }}" alt=""></div>
                        @elseif(isPremium($carDataMonthly)=='premium')
                        <div class="premium-tag"><img src="{{ asset('car-web/img/icons/special-mark.svg') }}" alt="">
                        </div>
                        @endif
                        @if(getMetasValue($carDataMonthly->metas, 'doctorVerified')==1)
                        <div class="doctor-verified-tag shadow-soft-blue"><img
                                src="{{ asset('car-web/img/cardoctor-logo.svg') }}" alt=""></div>
                        @endif
                        <div class="card-img">
                            <img src="{{$carDataMonthly->thumbnail()}}" class="img-fluid" alt="alt">

                            <div class="card-caption">
                                <div class="meta">{{ number_format($carDataMonthly->metaValue("mileageAmount"))}}
                                    {{$carDataMonthly->metaValue("mileageUnit")}}
                                    | {{$carDataMonthly->metaValue("fuelType")}}
                                    | {{ number_format($carDataMonthly->metaValue("capacityAmount"))}}
                                    {{$carDataMonthly->metaValue("capacityUnit")}}</div>
                            </div>
                        </div>
                        <div class="card-body py-2">
                            <div class="card-description">
                                <div class="card-desc-top">
                                    <div class="card-title">{{$carDataMonthly->title}}</div>
                                    @if(Auth::user()!=null && $carDataMonthly->author_id==Auth::user()->id)
                                    <div class="favorite">
                                        <span class="text-dark"><i class="fas fa-car"></i></span>
                                    </div>
                                    @else

                                    <div class="favorite saveToInterested" data-target="{{ $carDataMonthly->id }}" onclick="saveToInterested(event, this)">
                                        @if(Auth::check() && Auth::user()->hasMeta('interestedCars', $carDataMonthly->id))
                                        <span class="text-danger"><i class="fas fa-heart"></i></span>
                                        @else
                                        <span class="text-danger"><i class="icon-heart"></i></span>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="price">{{numerizePrice($carDataMonthly->metaValue("priceAmount"))}}
                                        {{$carDataMonthly->metaValue("priceUnit")}}</div>
                                </div>

                                <div class="card-meta">
                                    <div class="year">{{$carDataMonthly->metaValue("buildYear")}}
                                        / {{$carDataMonthly->metaValue("importDate")}}</div>
                                </div>
                                <div class="status">{{$carDataMonthly->metaValue("priceType")}}</div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach


            </div>

            <!-- Pagination -->
            @php
            $page = request("page", 1);
            @endphp
            <nav aria-label="Page navigation">
                <input type="hidden" value="{{ $page }}" name="page" id="page" />
                <ul class="pagination d-flex justify-content-end mt-2">
                    <li class="page-item {{ ($page <= 1)?'disabled':'' }}">
                        <button class="page-link" onclick="formSubmit('page', {{$page-1}})" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </button>
                    </li>
                    @for($i = 1; $i <= $cars->lastPage(); $i++)
                        <li class="page-item {{ ($i == $page)?'active':'' }}"><button class="page-link"
                                onclick="formSubmit('page', {{$i}})">{{ $i }}</button></li>
                        @endfor
                        <li class="page-item {{ ($page >= $cars->lastPage())?'disabled':'' }}">
                            <button class="page-link" onclick="formSubmit('page', {{$page+1}})" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </button>
                        </li>
                </ul>
            </nav>
            <!-- Pagination end -->
        </div>
    </div>
</div>