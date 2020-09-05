@push('modals')
<div class="modal fade" id="premiumAd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Үнэтэй зар болгох</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="make-premium" class="maz-form">
                <div class="row">


                        <div class="col-md-6 float-left">
                            <label for="bestPremium" class="col-md-12">
                            <div class="d-flex">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="bestPremium" name="publishType" value="best_premium" class="custom-control-input">
                                    <label class="custom-control-label" for="bestPremium"></label>
                                </div>
                                <h6 class="font-weight-bold mb-0">Best Premium</h6>
                            </div>

                            <select class="custom-select my-1 mr-sm-2" name="publishPriceAmountBest">
                                @getTaxonomys({"filter":[{"field":"taxonomy", "key":"best_premium"}], "returnValue":"bestPremium"})
                                @foreach($bestPremium as $data)
                                {{--<option>{{getMetasValue($data->term->name, 'amount')}}</option>--}}
                                {{--<option value="{{$data->term->meta->amount}}, {{$data->term->meta->unit}}, {{$data->term->meta->duration}}">{{$data->term->name}}</option>--}}
                                <option value="{{$data->term->id}}">{{$data->term->name}}</option>
                                @endforeach
                            </select>
                    </label>
                            <p>
                                Та зараа олон хүнд хүргэж, түргэн хугацаанд зарахыг хүсвэл Best Premium зарыг сонгоно уу.
                                </br>
                                Best Premium зар нь нүүр хуудас болон бусад хуудасны хамгийн дээд хэсэгт байрлах болно.
                                </br>
                                Зөвхөн 12 ширхэг зар байрлах учраас олонд хүрэх хүртээмж нь их.
                            </p>
                        </div>

                    <div class="col-md-6 float-left">
                        <div id="best-zar"></div>
                    </div>

                        <div class="col-md-6 float-left">
                            <label for="premium" class="col-md-12">
                            <div class="d-flex">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="premium" name="publishType" value="premium" class="custom-control-input">
                                    <label class="custom-control-label" for="premium"></label>
                                </div>
                                <h6 class="font-weight-bold mb-0">Premium</h6>
                            </div>

                            <select class="custom-select my-1 mr-sm-2" name="publishPriceAmountPremium">
                                @getTaxonomys({"filter":[{"field":"taxonomy", "key":"premium"}], "returnValue":"premium"})
                                @foreach($premium as $data)
                                {{--<option>{{getMetasValue($data->term->name, 'amount')}}</option>--}}
                                {{--<option value="{{$data->term->meta->amount}}, {{$data->term->meta->unit}}, {{$data->term->meta->duration}}">{{$data->term->name}}</option>--}}
                                <option value="{{$data->term->id}}">{{$data->term->name}}</option>
                                @endforeach
                            </select>
                            </label>
                            <p>
                                Онцгой машин хайж байгаа худалдан авагчдад өөрийн машиныг сурталчлах боломжтой.
                                </br>
                                Машин хайх хэсгийн хамгийн дээр байрлана.
                                </br>
                                Random аргаар харуулна.
                            </p>
                        </div>

                    <div class="col-md-6 float-left">
                        <div id="special-zar"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                    <button type="button" class="btn btn-primary" onclick="makePremium()" data-dismiss="modal">Илгээх</button>
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

var bestZar = {
        container: document.getElementById('best-zar'),
        renderer: 'svg',
        loop: false,
        rendererSettings: {
            progressiveLoad: true
        },
        autoplay: false,
        path: '{{asset("car-web/animation/bestAD.json")}}'
    },
    anim1 = bodymovin.loadAnimation(bestZar);

var specialZar = {
        container: document.getElementById('special-zar'),
        renderer: 'svg',
        loop: false,
        rendererSettings: {
            progressiveLoad: true
        },
        autoplay: false,
        path: '{{asset("car-web/animation/specialAD.json")}}'
    },
    anim2 = bodymovin.loadAnimation(specialZar);

var sentAD = {
        container: document.getElementById('sent-ad'),
        renderer: 'svg',
        loop: false,
        rendererSettings: {
            progressiveLoad: true
        },
        autoplay: false,
        path: '{{asset("car-web/animation/maz-send.json")}}'
    },
    anim3 = bodymovin.loadAnimation(sentAD);

$("input").click(function(){

    if($("input[name='publishType']")){
        if($(this).val() === "best_premium"){
            anim1.play();
            anim2.stop();
        }else if($(this).val() === "premium"){
            anim1.stop();
            anim2.play();
        }
        console.log($(this).val())

    }
});
var makeCarId=0;
function transferId(id) {
    makeCarId=id
}

function makePremium() {
    var paramObjs = {};
    $.each($('#make-premium').serializeArray(), function(_, kv) {
        paramObjs[kv.name] = kv.value;
    });
    var publishPricing;
    if(paramObjs.publishType==="best_premium"){
        publishPricing = paramObjs.publishPriceAmountBest;
    }
    else if(paramObjs.publishType==="premium"){
        publishPricing = paramObjs.publishPriceAmountPremium;
    }
    else{
        publishPricing = 0;
    }

    if(makeCarId!==0){
        $.ajax({
            type: 'POST',
            url: '/ajax/contents/' + makeCarId + '/publish',
            data: {"status":'{{ \App\Content::STATUS_PUBLISHED}}', "visibility":'{{ \App\Content::VISIBILITY_PUBLIC }}', "publishPricing": publishPricing, "publishType": paramObjs.publishType}
        }).done(function(data) {
            if (typeof nextPrev === "function") {
                nextPrev(1);
            }
            console.log("DONE!");
            console.log(data);
            if (paramObjs.publishType === "free") {
                $("#responseText").html("Амжилттай бүртгэгдлээ. Үнэтэй зараар өөрчлөхийг хүсвэл, Cash буюу үйлчилгээний төлбөрөө шилжүүлсний дараагаар Миний хуудас дахь үнэтэй зар болгох хэсэгт хүсэлтэй илгээнэ үү.");
            } else {
                $("#responseText").html("Амжилттай бүртгэгдлээ. Үйлчилгээний төлбөрийг таны үлдэгдэл Cash-аас тооцсон болно.");
            }
            $('#carRegSuccess').modal('show');
            setTimeout(function(){
                anim3.play();
            }, 700);

            setTimeout(function(){
                window.location.href = "/posts/"+makeCarId;
            }, 3000);

        }).fail(function(err) {
            console.log(err);
            if (err.responseJSON.hasOwnProperty('message')) {
                if (err.responseJSON['message'] == 'Insufficient cash') {
                    $("#responseText").html("Таны үлдэгдэл хүрэлцэхгүй байгаа тул Cash-aa цэнэглэнэ үү.");
                    $('#carRegSuccess').modal('show');
                    setTimeout(function(){
                        anim3.play();
                    }, 700);

                    setTimeout(function(){
                        window.location.href = "/charge-cash?id=" + makeCarId;
                    }, 3000);

                }
            }
        });
    }

}
</script>
@endpush
