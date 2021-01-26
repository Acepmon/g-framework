@push('modals')
<div class="modal fade" id="modalLoanCalculator" tabindex="-1" role="dialog" aria-labelledby="modalLoanCalculatorLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="loan-check">
            @csrf
            <div class="modal-body px-5">
                <div class="maz-modal-title">Зээлийн нөхцөл шалгах</div>
                <div class="maz-modal-desc">Энэ формыг бөглөнө үү. Бид тантай дараа холбоо барих болно. Утас: 7011-3322, 7011-8282</div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Таны нэр:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <input type="hidden" name="title" value="Loan Check">
                    <input type="hidden" name="slug" value="{{ \Str::uuid() }}">
                    <input type="hidden" name="type" value="{{ \App\Content::TYPE_LOAN_CHECK }}">
                    <input type="hidden" name="status" value="{{ \App\Content::STATUS_DRAFT }}">
                    <input type="hidden" name="visibility" value="{{ \App\Content::VISIBILITY_PUBLIC }}">
                    @auth
                    <input type="hidden" name="author_id" value="{{ \Auth::user()->id }}">
                    @endauth

                    <label for="reg-num" class="col-form-label">Регистерийн дугаар:</label>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <select id="reg-letter-1" class="form-control">
                                <option>А</option>
                                <option>Б</option>
                                <option>В</option>
                                <option>Г</option>
                                <option>Д</option>
                                <option>Е</option>
                                <option>Ё</option>
                                <option>Ж</option>
                                <option>З</option>
                                <option>И</option>
                                <option>Й</option>
                                <option>К</option>
                                <option>Л</option>
                                <option>М</option>
                                <option>Н</option>
                                <option>О</option>
                                <option>Ө</option>
                                <option>П</option>
                                <option>Р</option>
                                <option>С</option>
                                <option>Т</option>
                                <option>У</option>
                                <option>Ү</option>
                                <option>Ф</option>
                                <option>Х</option>
                                <option>Ц</option>
                                <option>Ч</option>
                                <option>Ш</option>
                                <option>Э</option>
                                <option>Ю</option>
                                <option>Я</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <select id="reg-letter-2" class="form-control">
                                <option>А</option>
                                <option>Б</option>
                                <option>В</option>
                                <option>Г</option>
                                <option>Д</option>
                                <option>Е</option>
                                <option>Ё</option>
                                <option>Ж</option>
                                <option>З</option>
                                <option>И</option>
                                <option>Й</option>
                                <option>К</option>
                                <option>Л</option>
                                <option>М</option>
                                <option>Н</option>
                                <option>О</option>
                                <option>Ө</option>
                                <option>П</option>
                                <option>Р</option>
                                <option>С</option>
                                <option>Т</option>
                                <option>У</option>
                                <option>Ү</option>
                                <option>Ф</option>
                                <option>Х</option>
                                <option>Ц</option>
                                <option>Ч</option>
                                <option>Ш</option>
                                <option>Э</option>
                                <option>Ю</option>
                                <option>Я</option>
                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="number" class="form-control" id="reg-num" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-form-label">Утасны дугаар:</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                </div>
                <div class="modal-footer pb-5">
                    <button type="submit" id="btnSendLoanCheck" class="btn btn-danger btn-round px-5 py-2 shadow-red">Илгээх</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush

@push('scripts')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $("#btnSendLoanCheck").on('click', function(event) {
        event.stopPropagation();
        event.preventDefault();
        var paramObjs = {};
        paramObjs['registrationNumber'] = $("#reg-letter-1").val() + $("#reg-letter-2").val() + $("#reg-num").val();
        $.each($('#loan-check').serializeArray(), function(_, kv) {
            paramObjs[kv.name] = kv.value;
        });

        $("#demo-spinner").css({'display': 'block'});
        $.ajax({
            type: 'POST',
            url: '{{ route('ajax.contents.store') }}',
            data: paramObjs
        }).done(function(data) {
            setCookie('guest_id', data['author_id'], 1);
            $("#demo-spinner").css({'display': 'none'});
            $("#modalLoanCalculator").modal('hide');
        }).fail(function(err) {
            $("#demo-spinner").css({'display': 'none'});
            console.error("FAIL!");
            console.error(err);
        });
    });
});

function setCookie(key, value, expiry) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}
</script>
@endpush
