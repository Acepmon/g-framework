@if ($content)
    <section class="detail-items bg-white detail-basic-information">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="detail-section-title">
                        <p>
                            Ерөнхий мэдээлэл
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="title">Ерөнхий</div>
                    <div class="info-list">
                        <ul>
                            @if ($content->metaValue('carType') && \App\Term::where('name', $content->metaValue('carType'))->first())
                                <li>
                                    <span class="info-icon">
                                        <img src="{{ asset('car-web/img/icons/' . strtolower(\App\Term::where('name', $content->metaValue('carType'))->first()->metaValue('value')) . '.svg') }}" alt="">
                                        <p>{{ $content->metaValue('carType') }}</p>
                                    </span>
                                </li>
                            @endif

                            @if ($content->metaValue('manCount'))
                                <li>
                                    <span class="info-icon">
                                        <img src="{{ asset('car-web/img/icons/passenger.svg') }}" alt="">
                                        <p>{{ $content->metaValue('manCount') }}</p>
                                    </span>
                                </li>
                            @endif

                            @if ($content->metaValue('doorCount'))
                                <li>
                                    <span class="info-icon">
                                        <img src="{{ asset('car-web/img/icons/door.svg') }}" alt="">
                                        <p>{{ $content->metaValue('doorCount') }} (Хаалга)</p>
                                    </span>
                                </li>
                            @endif

                            @if ($content->metaValue('colorNameInterior'))
                                <li>
                                    <span class="info-icon color" data-color="{{ strtolower(ucfirst(\App\Term::where('name', $content->metaValue('colorNameInterior'))->first()->metaValue('value'))) }}">
                                        <p>{{ ucfirst(\App\Term::where('name', $content->metaValue('colorNameInterior'))->first()->metaValue('value')) }} (Гадна)</p>
                                    </span>
                                </li>
                            @endif

                            @if ($content->metaValue('colorName'))
                                <li>
                                    <span class="info-icon color" data-color="{{ strtolower(ucfirst(\App\Term::where('name', $content->metaValue('colorName'))->first()->metaValue('value'))) }}">
                                        <p>{{ ucfirst(\App\Term::where('name', $content->metaValue('colorName'))->first()->metaValue('value')) }} (Салон)</p>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="title">Үзүүлэлт</div>
                    <div class="info-list">
                        <ul>
                            @if ($content->metaValue('capacityAmount'))
                                <li>
                                    <span class="info-icon">
                                        <img src="{{ asset('car-web/img/icons/engine.svg') }}" alt="">
                                        <p>{{ $content->metaValue('capacityAmount') }}{{ $content->metaValue('capacityUnit') }}</p>
                                    </span>
                                </li>
                            @endif

                            @if ($content->metaValue('wheelPosition'))
                                <li>
                                    <span class="info-icon">
                                        <img src="{{ asset('car-web/img/icons/wheel.svg') }}" alt="">
                                        <p>{{ $content->metaValue('wheelPosition') }} хүрд</p>
                                    </span>
                                </li>
                            @endif

                            @if ($content->metaValue('transmission'))
                                <li>
                                    <span class="info-icon">
                                        <img src="{{ asset('car-web/img/icons/gearShift.svg') }}" alt="">
                                        <p>{{ $content->metaValue('transmission') }}</p>
                                    </span>
                                </li>
                            @endif

                            @if ($content->metaValue('fuelType'))
                                <li>
                                    <span class="info-icon">
                                        <img src="{{ asset('car-web/img/icons/fuel.svg') }}" alt="">
                                        <p>{{ $content->metaValue('fuelType') }}</p>
                                    </span>
                                </li>
                            @endif

                            @if ($content->metaValue('wheelDrive'))
                                <li>
                                    <span class="info-icon">
                                        <img src="{{ asset('car-web/img/icons/transmission.svg') }}" alt="">
                                        <p>{{ $content->metaValue('wheelDrive') }}</p>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>


            @if($content->metaArray('advantages'))
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="title">Давуу тал</div>

                    <div class="info-list">
                        <ul style="grid-template-columns: auto auto auto auto">
                            @foreach($content->metaArray('advantages') as $advantage)
                                <li><i class="fab fa fa-check advantage-check"></i> {{ $advantage }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
@endif

<style>
.advantage-check {
    padding: .5rem;
    background: #e0e5eb;
    border-radius: 50%;
    font-size: .5rem;
    margin-right: 20px
}
</style>