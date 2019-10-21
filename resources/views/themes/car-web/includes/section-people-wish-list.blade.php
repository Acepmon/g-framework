<section class="mainPage-items bg-white">
    <div class="container">
        <div class="row">
            <div class="section-title">
                <h2>People's wish list</h2>
                <span>
            <a href="/wishlist">See all ( @contentsTotal({"filter":[{"field":"type", "key":"wanna-buy"}, {"field":"status", "key":"published"}, {"field":"visibility", "key":"public"}]}) ) <i class="fab fa fa-angle-right"></i></a>

          </span>
            </div>
        </div>
    </div>
    <div class="people-wish-list">
        <div class="container">
            <div class="row">
                <div class="card-slide owl-carousel owl-theme">


                    @content(type=wanna-buy, status=published, visibility=public, limit=12 as $wannaBuyData | paginate)
                    <!-- card start -->
                        <div class="card">
                            <div class="card-top">
                                <h2 class="title">{{$wannaBuyData->title}}</h2>
                            </div>
                            <div class="card-body py-2">
                                <div class="wish-detail">
                                    <div class="price"><i class="icon-tag"></i>{{numerizePrice((getMetasValue($wannaBuyData->metas,'priceAmountStart')))}}-{{numerizePrice((getMetasValue($wannaBuyData->metas,'priceAmountEnd')))}}</div>
                                    <div class="phone"><i class="icon-phone"></i> {{(getMetasValue($wannaBuyData->metas,'retailPhone'))}}</div>
                                </div>
                                <div class="wish-user">
                                    <div class="profile-img"><img src="{{$wannaBuyData->author->avatar}}" alt=""></div>
                                    <div class="username">@if($wannaBuyData->author->name!=null){{$wannaBuyData->author->name}}@else {{$wannaBuyData->author->username}}@endif <div class="date">{{(getMetasValue($wannaBuyData->metas,'created_at'))}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- card end -->
                    @endcontent
                </div>
            </div>
        </div>
    </div>
</section>


