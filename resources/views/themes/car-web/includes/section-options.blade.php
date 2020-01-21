@if ($content)
    <section class="detail-items bg-white detail-option-information">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="detail-section-title">
                        <p>
                            Опшин хэсэг
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="title">Гаднах байдал</div>
                    <div class="info-list">
                        <ul>
                            @foreach(\App\TermTaxonomy::where('taxonomy', 'car-exterior')->get() as $taxonomy)
                                @if ($content->terms->contains($taxonomy->term->id))
                                    <li><i class="fab fa fa-check"></i> {{ $taxonomy->term->name }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="title">Дотор байдал</div>
                    <div class="info-list">
                        <ul>
                            @foreach(\App\TermTaxonomy::where('taxonomy', 'car-guts')->get() as $taxonomy)
                                @if ($content->terms->contains($taxonomy->term->id))
                                    <li><i class="fab fa fa-check"></i> {{ $taxonomy->term->name }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="title">Аюулгүй байдал</div>
                    <div class="info-list">
                        <ul>
                            @foreach(\App\TermTaxonomy::where('taxonomy', 'car-safety')->get() as $taxonomy)
                                @if ($content->terms->contains($taxonomy->term->id))
                                    <li><i class="fab fa fa-check"></i> {{ $taxonomy->term->name }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="title">Тав тух</div>
                    <div class="info-list">
                        <ul>
                            @foreach(\App\TermTaxonomy::where('taxonomy', 'car-convenience')->get() as $taxonomy)
                                @if ($content->terms->contains($taxonomy->term->id))
                                    <li><i class="fab fa fa-check"></i> {{ $taxonomy->term->name }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
