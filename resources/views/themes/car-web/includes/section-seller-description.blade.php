@if ($content)
    <section class="bg-white detail-option-information">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="detail-section-title">
                        <p>
                            Нэмэлт мэдээлэл
                        </p>
                    </div>

                    <div class="dealer-description">
                        <p>{!! $content->metaValue('sellerDescription') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
