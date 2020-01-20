@push('styles')
    <style>
        .dropzone {
            background: white;
            border-radius: 5px;
            border: 2px dashed #ddd;
            border-image: none;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endpush

@if ($content)
    <section class="section text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card vehicle-info-top shadow-soft-blue">
                        <div class="card-body text-left">
                            <div class="row">
                                <div class="col-md-7">
                                    @if ($content->title)
                                        <h1 class="vehicle-title">{{ $content->title }}</h1>
                                    @endif
                                    <p class="vehicle-meta text-muted">Үйлдвэрлэсэн он: {{$content->metaValue('buildYear')}} / Орж ирсэн он: {{$content->metaValue('importDate')}}</p>
                                    <p class="vehicle-meta text-muted">Гүйлт: {{$content->metaValue('mileageAmount')}} {{$content->metaValue('mileageUnit')}} |
                                        Шатхуун: {{$content->metaValue('fuelType')}} | Хөдөлгүүрийн багтаамж: {{$content->metaValue('capacityAmount')}} {{$content->metaValue('capacityUnit')}}
                                    </p>


<!--                                    @if ($content->metaArray('advantages'))-->
<!--                                        <p class="vehicle-meta text-muted">{{ implode(' | ', $content->metaArray('advantages')->toArray()) }}</p>-->
<!--                                    @endif-->

                                    <div class="d-flex align-items-center">
                                        @if ($content->metaValue('isAuction') && $content->metaValue('startPriceAmount'))
                                            <div class="vehicle-price"> <i class="icon-tag"></i> Үнэ: <span>{{ numerizePrice($content->metaValue('startPriceAmount')) }} {{ $content->metaValue('startPriceUnit') }}</span> </div>
                                        @elseif ($content->metaValue('priceAmount'))
                                            <div class="vehicle-price"> <i class="icon-tag"></i> Үнэ: <span>{{ numerizePrice($content->metaValue('priceAmount')) }} {{ $content->metaValue('priceUnit') }}</span> </div>
                                        @endif

                                        @if ($content->metaValue('isAuction'))
                                            <div class="vehicle-price ml-3">
                                                <img src="{{ asset('car-web/img/auction.svg') }}" alt="">
                                                Дуусах хугацаа: <span class="countdown" style="font-size: 1.2rem" data-countdown="{{ \Carbon\Carbon::parse($content->metaValue('endsAt'))->timezone(config('app.timezone')) }}"></span>
                                            </div>
                                        @endif

                                        <div class="vehicle-id mt-0">ID: <span>#{{ $content->id }}</span></div>
                                    </div>
                                </div>
                                <div class="col-md-5 text-right d-flex justify-content-between flex-column">
                                    @if ($content->metaValue('markName'))
                                        <div class="vehicle-brand">
                                            <img src="{{ url(asset('images/manufacturers/' . \Str::slug($content->metaValue('markName')) . '.png')) }}" alt="" width="80" class="mr-2 mt-2" style="vertical-align: top">
                                            <p>{{ $content->metaValue('markName') }}</p>
                                        </div>
                                    @endif

                                    <div class="control-ad">
                                        @if (Auth::check())
                                            @if ($content->metaValue('publishType') == 'free' && Auth::user()->id == $content->author_id)
                                                <a class="disabled btn btn-warning btn-round shadow-soft-blue btn-icon-left px-3" href="{{ url('/my-page/premiums') }}">
                                                    @include('themes.car-web.includes.premium-svg')
                                                    Рremium болгох
                                                </a>
                                            @endif

                                            @if (!$content->metaValue('doctorVerified') && Auth::user()->id == $content->author_id)
                                                <a class="btn btn-round shadow-soft-blue ml-3" href="#modalVerifyCar" id="modalVerifyCarLabel" data-toggle="modal">Баталгаажуулах</a>
                                            @endif

                                            @if (Auth::user()->id == $content->author_id)
                                                <a class="btn btn-round shadow-soft-blue ml-3" href="{{ url('edit?id='.$content->id) }}">Засах</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('modals')
        <div class="modal fade" id="modalVerifyCar" tabindex="-1" role="dialog" aria-labelledby="modalVerifyCarLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" id="modalVerifyCarClose" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-5">
                        <div class="maz-modal-title">Машинаа баталгаажуулах</div>
                        <div class="maz-modal-desc">Та авахыг хүсэж буй машиныхаа зарыг оруулсанаар машин худалдаалагч нар танруу таны хайж буй машиныг тань санал болгох болно.<br>Хүсэж буй машинаа олоход тань амжилт хүсье.</div>
                        <form>
                            <input type="doctorVerificationRequest" value="true" hidden>
                            <div class="form-group mt-4">
                                <label for="doctorVerificationFile" class="col-form-label">Doctor Verify
                                    <span data-toggle="tooltip" data-placement="top" title="Баталгаажуулах файлаа илгээнэ үү" class="ml-2 icon-question"></span>
                                </label>

                                <!-- <div class="dropzone">
                                    <input type="file" name="doctorVerificationFile" id="doctorVerificationFile" hidden>
                                    <span>Upload</span>
                                </div> -->
                                <div class="custom-file">
                                    <input name="doc" type="file" class="custom-file-input" id="docFile">
                                    <label class="custom-file-label" for="docFile">Файл сонгох</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer pb-5">
                        <button type="button" class="btn btn-danger btn-round px-5 py-2 shadow-red" onclick="sendDoctorVerify()">Send</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="docVerSuccess">
            <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Doctor баталгаажуулалт</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body mt-4 pr-lg-5 pl-lg-5 text-center">
                        Doctor баталгаажуулалт илгээгдлээ! Админ таны хүсэлтийг харж баталгаажуулах болно.
                    </div>
                </div>
            </div>
        </div>
    @endpush

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        </script>
    @endpush

    @push('scripts')
        <script>
            var mazCountdown = $('.countdown');
            var mazCDtime = mazCountdown.data('countdown');

            var countDownDate = new Date(mazCDtime).getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {
                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                mazCountdown.html((hours + days * 24) + " цаг "
                + minutes + " мин " + seconds + " сек ");

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    mazCountdown.html("ДУУССАН");
                }
            }, 1000);

            function sendDoctorVerify() {
                $("#demo-spinner").css({'display': 'block'});
                var docData = new FormData();
                let doctorsFile = $("#docFile")[0].files[0];
                docData.append('doc', doctorsFile);
                $.ajax({
                    type: 'POST',
                    url: '/ajax/contents/{{ $content->id }}/doc',
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: docData
                }).done(function(data) {
                    $("#demo-spinner").css({'display': 'none'});
                    $('#docVerSuccess').modal('show');
                    $("#modalVerifyCarClose").click();
                }).fail(function () {
                    $("#demo-spinner").css({'display': 'none'});
                    alert("File is not uploaded. Please try again later");
                });
            }
        </script>
    @endpush

@endif
