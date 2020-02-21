
@if ($content)
@if ($content->author->get_dealer_group() != null)

    <section class="bg-white detail-option-information">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="detail-section-title">
                        <p>
                            Диллерийн мэдээлэл
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    @if ($content->author->get_dealer_group()->metaValue('retailImage'))
                        <img src="{{ $content->author->get_dealer_group()->metaValue('retailImage') }}" alt="" class="img-fluid">
                    @endif
                </div>
                <div class="col-md-7">
                    <div class="retail-information">
                        {{$content->author->get_dealer_group()->phone}}
                        @if ($content->title)
                            <div class="d-flex justify-content-between retail-head py-2">
                                <div class="retail-name">{{ $content->author->get_dealer_group()->title }}</div>
                                @if ($content->author->get_dealer_group()->phone)
                                <div class="retail-phone">{{ format_phone($content->author->get_dealer_group()->phone) }}</div>
                                @endif
                                <!-- @if ($content->metaValue('phone'))
                                    <div class="retail-phone">{{ format_phone($content->metaValue('phone')) }}</div>
                                @endif -->
                            </div>
                        @endif

                        @if ($content->author->get_dealer_group()->metaValue('address'))
                            <div class="retail-row">
                                <div class="row-title">Хаяг</div>
                                <div class="row-info">{{ $content->author->get_dealer_group()->metaValue('address') }}</div>
                            </div>
                        @endif

                        @if ($content->author->get_dealer_group()->metaValue('schedule'))
                            <div class="retail-row">
                                <div class="row-title">Нээлттэй цаг</div>
                                <div class="row-info">{{ $content->author->get_dealer_group()->metaValue('schedule') }}</div>
                            </div>
                        @endif

                        <!-- @if ($content->metaValue('vehicles'))
                            <div class="retail-row">
                                <div class="row-title">A reserved vehicle</div>
                                <div class="row-info">{{ $content->metaValue('vehicles') }} vehicles</div>
                            </div>
                        @endif -->

                        @if ($content->author->get_dealer_group()->metaValue('retailPhone'))
                            <div class  ="retail-row">
                                <div class="row-title">Утас</div>
                                <div class="row-info">{{ $content->author->get_dealer_group()->metaValue('retailPhone') }}</div>
                            </div>
                        @endif
                        @if ($content->author->get_dealer_group()->metaValue('website'))
                        <div class  ="retail-row">
                            <div class="row-title">Веб хуудас</div>
                            <div class="row-info">
                                <a href="{{ $content->author->get_dealer_group()->metaValue('website') }}" target="_blank">{{ $content->author->get_dealer_group()->metaValue('website') }}</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
@endif
