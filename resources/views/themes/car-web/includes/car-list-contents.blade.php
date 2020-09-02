<div class="card shadow-soft-blue page-top-navbar">
  @if($type == 'search')
  <div class="card-body">
      <span class="d-flex justify-content-start font-weight-bold mb-2">
          Хайлт: 
          @if(request('advantage', True))
          @foreach(request('advantage', []) as $advantage)
              <button type="button" class="badge badge-light pl-3 pr-3 ml-2 mr-2" onclick="removeAdvantage('{{ $advantage }}')">{{ $advantage }} x</button>
          @endforeach
          @endif
      </span>
      <div class="input-group">
        <span class="input-group-prepend">
          <div class="form-control bg-transparent"><i class="fa fa-search"></i></div>
        </span>
        <input id="searchPage" type="search" class="form-control border-left-0" placeholder="Хайх утгаа оруулна уу..." value="{{ $search }}" onsearch="formSubmit('searchInput', this.value)">
      </div>
  </div>
  @endif
  <div class="d-flex justify-content-start">
    <span class="total-cars">Нийт {{ $items->total() }}</span>
    <input type="hidden" name="orderBy" id="orderBy" value="{{ $orderBy }}" />
    <input type="hidden" name="orderDir" id="orderDir" value="{{ $orderDir }}" />

    <div class="sort-cars">
    <ul>
      @if ($orderBy=='publishedAt')
          @if ($orderDir=='desc')
          <li class="active"><a href="#" onclick="formSubmit('orderBy', 'publishedAt', 'orderDir', 'asc')">Сүүлд нийтлэгдсэн ▼</a></li>
          @else
          <li class="active"><a href="#" onclick="formSubmit('orderBy', 'publishedAt', 'orderDir', 'desc')">Өмнө нь нийтлэгдсэн ▲</a></li>
          @endif
      @else
          <li><a href="#" onclick="formSubmit('orderBy', 'publishedAt', 'orderDir', 'desc')">Сүүлд нийтлэгдсэн</a></li>
      @endif
      
      @if ($orderBy=='buildYear')
          @if ($orderDir=='desc')
          <li class="active"><a href="#" onclick="formSubmit('orderBy', 'buildYear', 'orderDir', 'asc')">Үйлдвэрлэгдсэн он ▼</a></li>
          @else
          <li class="active"><a href="#" onclick="formSubmit('orderBy', 'buildYear', 'orderDir', 'desc')">Үйлдвэрлэгдсэн он ▲</a></li>
          @endif
      @else
          <li><a href="#" onclick="formSubmit('orderBy', 'buildYear', 'orderDir', 'desc')">Үйлдвэрлэгдсэн он</a></li>
      @endif
      
      @if ($orderBy=='importDate')
          @if ($orderDir=='desc')
          <li class="active"><a href="#" onclick="formSubmit('orderBy', 'importDate', 'orderDir', 'asc')">Орж ирсэн он ▼</a></li>
          @else
          <li class="active"><a href="#" onclick="formSubmit('orderBy', 'importDate', 'orderDir', 'desc')">Орж ирсэн он ▲</a></li>
          @endif
      @else
          <li><a href="#" onclick="formSubmit('orderBy', 'importDate', 'orderDir', 'desc')">Орж ирсэн он</a></li>
      @endif
      
      @if ($orderBy=='priceAmount')
          @if ($orderDir=='desc')
          <li class="active"><a href="#" onclick="formSubmit('orderBy', 'priceAmount', 'orderDir', 'desc')">Хямд үнэ ▼</a></li>
          @else
          <li class="active"><a href="#" onclick="formSubmit('orderBy', 'priceAmount', 'orderDir', 'asc')">Хамгийн үнэтэй ▲</a></li>
          @endif
      @else
          <li><a href="#" onclick="formSubmit('orderBy', 'priceAmount', 'orderDir', 'asc')">Хямд үнэ</a></li>
      @endif
    </ul>
    </div>
  </div>
</div>

@if ($items->all() && sizeof($items->all()) != 0)
  @php
    if (sizeof($items->all()) < ($page-0) * $itemsPerPage) {
      $page = 1;
    }
  @endphp
  <div class="car-list {{ ($type == 'auction')?'auction-list':'' }}">
    @if ($type == 'auction')
        @foreach($items->forPage($page, $itemsPerPage) as $car)
            @include('themes.car-web.includes.car-list-card', array('car'=>$car, 'type'=>'auction'))
        @endforeach
    @else
        @foreach($items as $car)
            @include('themes.car-web.includes.car-list-card', array('car'=>$car))
        @endforeach
    @endif
  </div>
@else
  <div class="text-center text-muted col-lg-12 mt-3">
    <p>Үр дүн олдсонгүй</p>
  </div>
@endif

@if ($items->all() && sizeof($items->all()) != 0)
<!-- Pagination -->
<nav aria-label="Page navigation">
    <input type="hidden" value="{{ max($page, 1) }}" name="page" id="page" />
    <ul class="pagination d-flex justify-content-end">
    <li class="page-item {{ ($page <= 1)?'disabled':'' }}">
        <button class="page-link" onclick="formSubmit('page', {{$page-1}})" aria-label="Previous">
        <span aria-hidden="true"><i class="fab fa fa-angle-left"></i></span>
        </button>
    </li>
    @for($i = 1; $i <= $maxPage; $i++)
        <li class="page-item {{ ($i == $page)?'active':'' }}"><button class="page-link" onclick="formSubmit('page', {{$i}})">{{ $i }}</button></li>
        @endfor
        <li class="page-item {{ ($page >= $maxPage)?'disabled':'' }}">
        <button class="page-link" onclick="formSubmit('page', {{$page+1}})" aria-label="Next">
            <span aria-hidden="true"><i class="fab fa fa-angle-right"></i></span>
        </button>
        </li>
    </ul>
</nav>
<!-- Pagination end -->
@endif