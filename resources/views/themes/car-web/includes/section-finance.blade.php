@if ($content)
    <section class="mainPage-items bg-light text-center mt-5 finance-section" id="section-finance">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center ">
                    <div class="finance-title">
                        <h1>Зээлийн тооцоолуур</h1>
                        <p>20-80% урьдчилгаа төлөөд хүү багатай зээлээр аваарай</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-soft-blue">
                        <div class="card-body text-left">
                            <form>
                                <input type="text" value="{{ $content->metaValue('priceAmount') }}" name="carPrice" id="carPrice" hidden>
                                <p>Урьдчилгаа төлбөр (эхний 20%)</p>
                                <div class="select-first-price">
                                    @foreach (\App\Entities\TaxonomyManager::collection('car-advance-payments') as $index => $advancePayment)
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="{{ $advancePayment->term->name }}%" name="advancePaymentPercent" value="{{ $advancePayment->term->name }}" class="advancePayment custom-control-input" {{ $index == 0 ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="{{ $advancePayment->term->name }}%">{{ $advancePayment->term->name }}%</label>
                                        </div>
                                    @endforeach
                                </div>
                                <p>Зээлийн хугацаа</p>
                                <div class="select-month">
                                    @foreach (\App\Entities\TaxonomyManager::collection('car-loan-terms') as $index => $loanTerm)
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="{{ $loanTerm->term->name }}month" name="loanTerm" value="{{ $loanTerm->term->name }}" data-interest="{{ $loanTerm->term->metaValue('interest') }}" class="loanTerm custom-control-input" {{ $index == 0 ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="{{ $loanTerm->term->name }}month">{{ $loanTerm->term->name }} сар</label>
                                        </div>
                                    @endforeach
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card monthly-payment">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="payment-information">
                                <div class="info">
                                    <p>Урьдчилгаа төлбөр</p>
                                    <p class="font-weight-bold"><span id="advancePaymentAmount">1,400,000</span> ₮</p>
                                </div>
                                <div class="info">
                                    <p>Сар бүр төлөх дүн</p>
                                    <p class="monthly"><span id="monthlyPaymentAmount">427,938</span> ₮</p>
                                </div>
                            </div>
                            <a class="btn btn-light btn-round btn-block my-3 shadow-soft-blue p-2" href="#" data-toggle="modal"
                            data-target="#modalLoanCalculator" data-whatever="@getbootstrap">Зээлийн тооцоолуур</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('themes.car-web.includes.modal-loan-check')
@endif

@push('scripts')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function number_format (number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

function PMT(rate, nper, pv, fv, type) {
    if (!fv) fv = 0;
    if (!type) type = 0;

    if (rate == 0) return -(pv + fv)/nper;

    var pvif = Math.pow(1 + rate, nper);
    var pmt = rate / (pvif - 1) * -(pv * pvif + fv);

    if (type == 1) {
        pmt /= (1 + rate);
    };

    return pmt;
}

function loanCalculation(price, advancePayment, loanTerm, interest = 2.5) {
    var advancePaymentAmount = price / 100 * advancePayment;
    var loanAmount = price - advancePaymentAmount;
    var monthlyInterest = interest;
    var yearlyInterest = monthlyInterest * 12;
    var interestPaymentMonthly = 0;
    var monthlyPaymentAmount = Math.round((PMT(monthlyInterest / 100, loanTerm - interestPaymentMonthly, -loanAmount, 0, 0)), 2);

    return {
        price,
        advancePayment,
        loanTerm,
        loanAmount,
        monthlyInterest,
        yearlyInterest,
        advancePaymentAmount,
        monthlyPaymentAmount
    }
}

function calculate(carPrice, advancePayment, loanTerm, interest) {
    var result = loanCalculation(parseFloat(carPrice), parseInt(advancePayment), parseInt(loanTerm), parseFloat(interest));
    $("#advancePaymentAmount").html(number_format(result.advancePaymentAmount));
    $("#monthlyPaymentAmount").html(number_format(result.monthlyPaymentAmount));
}

$(document).ready(function() {
    $(".advancePayment").change(function () {
        calculate($("#carPrice").val(), $(".advancePayment:checked").val(), $(".loanTerm:checked").val(), $(".loanTerm:checked").data('interest'));
    });

    $(".loanTerm").change(function () {
        calculate($("#carPrice").val(), $(".advancePayment:checked").val(), $(".loanTerm:checked").val(), $(".loanTerm:checked").data('interest'));
    });

    calculate($("#carPrice").val(), $(".advancePayment:checked").val(), $(".loanTerm:checked").val(), $(".loanTerm:checked").data('interest'));
});

</script>
@endpush
