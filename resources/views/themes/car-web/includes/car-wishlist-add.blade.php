@push('modals')
    <div class="modal fade" id="modalAddWishlist" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="add-wish">
                    <div class="modal-body px-5 pt-0">
                        <div class="maz-modal-title">Авахыг хүсэж буй машинаа оруулна уу</div>
                        <div class="maz-modal-desc">Та авахыг хүсэж буй машиныхаа зарыг оруулсанаар машин худалдаалагч нар танруу таны хайж буй машиныг тань санал болгох болно. Хүсэж буй машинаа олоход тань амжилт хүсье</div>
                        <div class="form-row mt-5">
                            <div class="form-group col-md-6">
                                <label for="Manufacturer">Үйлдвэрлэгч:</label>
                                <select id="addWishMark" name="markName" class="form-control" required>
                                    @foreach(App\TermTaxonomy::where('taxonomy', 'car-manufacturer')->get() as $taxonomy)
                                        <option value="{{$taxonomy->term->name}}">{{$taxonomy->term->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Model">Загвар:</label>
                                <select id="addWishModel" name="modelName" class="form-control" required></select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="priceAmountStart">Эхлэх үнэ</label>
                                <div class="input-group">
                                    <input type="text" name="priceAmountStart" class="form-control" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">₮</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="priceAmountEnd">Дуусах үн</label>
                                <div class="input-group">
                                    <input type="text" name="priceAmountEnd" class="form-control" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">₮</span>
                                    </div>
                                </div>
                            </div>
                            <input type="text" name="priceUnit" value="₮" hidden>
                        </div>
                    </div>
                    <div class="modal-footer pb-5">
                        <button type="submit" id="btnSendWish" class="btn btn-danger btn-round px-5 py-2 shadow-red">Илгээх</button>
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

    $(document).ready(function () {
        var onChange = function (markName, modelNameElement) {
            $.getJSON('/api/v1/taxonomies/car-' + toKebabCase(markName), function (data) {
                var modelList=data;
                modelNameElement.find('option').remove().end().append('<option value=""></option>').val('');
                for (var i = 0; i < modelList.data.length; i++) {
                    modelNameElement.append(new Option(modelList.data[i].term.name, modelList.data[i].term.name));
                }
            });
        }
        var onSubmit = function () {
            var markName = $("#add-wish").find('select[name=markName]').val();
            var modelName = $("#add-wish").find('select[name=modelName]').val();
            var priceUnit = $("#add-wish").find('input[name=priceUnit]').val();
            var priceAmountStart = $("#add-wish").find('input[name=priceAmountStart]').val();
            var priceAmountEnd = $("#add-wish").find('input[name=priceAmountEnd]').val();

            var data = {
                'title': markName + ' ' + modelName,
                'slug': '{{ \Str::uuid() }}',
                'type': 'wanna-buy',
                'status': '{{ \App\Content::STATUS_PUBLISHED }}',
                'visibility': '{{ \App\Content::VISIBILITY_PUBLIC }}',
                'author_id': '{{ Auth::user()->id }}'
            };

            $.ajax({
                type: 'POST',
                url: '/ajax/contents',
                data: data
            }).done(function(data) {
                var carId = data['id'];
                var paramObjs = {
                    "markName": markName,
                    "modelName": modelName,
                    "priceUnit": priceUnit,
                    "priceAmountStart": parseInt(priceAmountStart.replace(/,/g, '')),
                    "priceAmountEnd": parseInt(priceAmountEnd.replace(/,/g, ''))
                };
                $.ajax({
                    type: 'POST',
                    url: '/ajax/contents/' + carId + '/metas',
                    data: paramObjs
                }).done(function(data) {
                    $("#demo-spinner").css({'display': 'none'});
                    window.location.href = "/wishlist";
                });
            }).fail(function(err) {
                console.log(err);
                alert(err.responseJSON.message);
            });
        }

        $('#addWishMark').change(function () {
            onChange($(this).val(), $("#add-wish").find('select[name=modelName]'));
        });
        $("#add-wish").submit(function (e) {
            e.preventDefault();
            onSubmit();
            return false;
        });

        onChange($("#addWishMark").val(), $("#add-wish").find('select[name=modelName]'));

        $("#add-wish").find('input[name=priceAmountStart]').inputmask({alias: 'currency'});
        $("#add-wish").find('input[name=priceAmountEnd]').inputmask({alias: 'currency'});
    });
</script>
@endpush
