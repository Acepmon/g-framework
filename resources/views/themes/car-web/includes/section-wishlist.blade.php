@if($contents)
<section class="mainPage-items bg-white">
    <div class="container">
        <div class="row">
            <div class="section-title">
                <h2>{{ $title }}</h2>
                <span>
                    <a href="{{ $morelink }}">Бүгдийг харах ({{ count($contents) }}) <i class="fab fa fa-angle-right"></i></a>
                </span>
            </div>
        </div>
    </div>
    <div class="people-wish-list">
        <div class="container">
            <div class="row">
                <div class="card-slide owl-carousel owl-theme">
                    @foreach($contents->take(12) as $content)
                        <div class="card cd-box">
                            <div class="card-top">
                                <h2 class="title">{{ $content->metaValue('markName')}} </br> {{ $content->metaValue('modelName')}}</h2>
                            </div>
                            <div class="card-body py-2">
                                <div class="wish-detail">
                                    @if ($content->metaValue('priceAmountStart') && $content->metaValue('priceAmountEnd'))
                                        <div class="price"><i class="icon-tag"></i> {{ numerizePrice($content->metaValue('priceAmountStart')) }} ~ {{ numerizePrice($content->metaValue('priceAmountEnd')) }}</div>
                                    @endif

                                    @if ($content->author->metaValue('phone'))
                                        <div class="phone"><i class="icon-phone"></i> {{ $content->author->metaValue('phone') }}</div>
                                    @endif
                                </div>
                                <div class="wish-user">
                                    <div class="profile-img"><img src="{{ $content->author->avatar_url() }}" alt="{{ $content->author->name }}"></div>
                                    <div class="username">{{ $content->author->name }} <div class="date">{{ $content->created_at->format('Y-m-d') }}</div></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
