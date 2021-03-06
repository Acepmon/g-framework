@if ($content && $content->metaValue('isAuction'))
    <div class="card">
        <div class="card-body">
            <div class="dealer-information">
                <div class="dealer-meta flex-fill">
                    <h4>{{ number_format($content->metaValue('startPriceAmount')) }} {{ $content->metaValue('startPriceUnit') }}</h4>
                </div>
                <div class="dealer-meta">
                    <a href="#" class="dealer-status text-right">{{ $content->metaValue('bids') }} үнийн саналтай</a>
                </div>
            </div>

            <div class="dealer-information">
                <input type="text" class="form-control" placeholder="{{ number_format($content->metaValue('startPriceAmount')) }} {{ $content->metaValue('startPriceUnit') }}-нөөс дээш">
            </div>

            <div class="dealer-information">
                <button type="button" class="btn btn-primary btn-round btn-sm btn-block my-4 shadow-soft-blue p-3 btn-icon-left mr-1">
                    Үнийн санал өгөх
                </button>
                <button type="button" class="btn btn-danger btn-round btn-sm btn-block my-4 shadow-soft-blue p-3 btn-icon-left ml-1">
                    Шууд авах
                </button>
            </div>
        </div>
    </div>
@endif
