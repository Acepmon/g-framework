@if ($content)
    <div class="card">
        <div class="card-body">
            <div class="dealer-information">
                @if ($content->metaValue('doctorVerified') && !$content->metaValue('doctorVerificationRequest'))
                    <div class="dealer-more">
                        <div class="value"><img src="{{ asset('car-web/img/icons/verify.svg') }}" alt=""></div>
                        <div class="title">Verify by
                            <span>DOCTOR</span></div>
                    </div>
                @else
                    <div class="dealer-more">
                        <div class="value"><img src="{{ asset('car-web/img/icons/verify.svg') }}" alt=""></div>
                        <div class="title">Not Verified</div>
                    </div>
                @endif

                @if ($content->metaValue('viewed'))
                    <div class="dealer-more">
                        <div class="value">
                            <p>{{ $content->metaValue('viewed') }}</p>
                        </div>
                        <div class="title">Нийт үзсэн тоо</div>
                    </div>
                @endif

                @if ($content->metaValue('interested'))
                    <div class="dealer-more">
                        <div class="value">
                            <p>{{ $content->metaValue('interested') }}</p>
                        </div>
                        <div class="title">Нийт сонирхсон</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
