@extends('themes.car-web.layouts.default')

@section('title', 'Бүртгүүлэх')

@section('load')
@endsection

@section('content')
<div class="bg-page-header"></div>

<section class="bg-transparent">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card sell-car shadow-soft-blue">
                    <div class="card-header">
                        <div class="step-process sp-2">
                            <div class='progress_inner_step active'>
                                <a class="nav-link" for='step-1' data-toggle="tab" href="#step-1" id="tab-step-1" role="tab" style="pointer-events: none;">Үйлчилгээний нөхцөл</a>
                            </div>
                            <div class='progress_inner_step'>
                                <a class="nav-link" for='step-2' data-toggle="tab" href="#step-2" id="tab-step-2" role="tab" style="pointer-events: none;">Нэвтрэх нэр & Нууц үг</a>
                            </div>
                            <!-- <div class='progress_inner_step' id="step-3id">
                                <a class="nav-link" for='step-3' data-toggle="tab" href="#step-3" id="tab-step-3" role="tab" style="pointer-events: none;">Нэмэлт мэдээлэл</a>
                            </div> -->
                        </div>
                    </div>
                    <form class="maz-form" id="register-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body pb-5 tab-content" id="steps">
                            <div id="step-1" class="tab-pane active show">

                                <div class="form-title"><span>Үйлчилгээний нөхцөл</span></div>

                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" name="termsOfCondition" id="termsOfCondition" class="custom-control-input" required>
                                    <label class="custom-control-label" for="termsOfCondition">Үйлчилгээний нөхцөл</label>
                                </div>

                                <div class="terms-text" style="text-align: left">
<p align="left">
    1.Нийтлэг үндэслэл
<br>
    2.Талуудын эрх үүрэг
<br>
    3.Үйлчилгээний төлбөр
<br>
    4.Компанийн хариуцлагын хязгаарлалт
<br>
    5.Үйлчилгээний нөхцөлийн хамрах хугацаа
<br>
    6.Үйлчилгээний нөхцлиийн нэмэлт өөрчлөлт
</p>
<p align="left">
    <strong>1. Нийтлэг үндэслэл</strong>
</p>
<p align="left">
    1.1. <strong>ДАМОА МОТОРС</strong><strong> </strong><strong>ХХК</strong>
    (цаашид “Компани” гэх) нь интернет сайт болох MAZ.mn болон iOS, Android
    үйлдлийн системтэй гар утасны програм дээр үзүүлэх үйлчилгээний нөхцөлийг
    нийтэлж байна.
</p>
<p align="left">
    1.2. Энэхүү нөхцөл нь Хэрэглэгч (цаашид “Хэрэглэгч” гэх) сайтаар
    үйлчлүүлэхээсээ өмнө хүлээн зөвшөөрч баталгаажуулсны үндсэн дээр хэрэгжинэ.
</p>
<p align="left">
    <a name="_GoBack"></a>
    1.3. Энэхүү нөхцөлд өөрөөр заагаагүй бол дараахь нэр томьёог дор дурдсан
    утгаар ойлгоно:
</p>
<ul>
    <li>
        <p align="left">
            Компани – ДАМОА МОТОРС ХХК
        </p>
    </li>
    <li>
        <p align="left">
            Сайт – MAZ.mn интернет сайт болон iOS, Android үйлдлийн системтэй
            гар утасны аппликейшн болох түр хугацааны зар байршуулах платформ
            (цаашид “Сайт” гэх)
        </p>
    </li>
    <li>
        <p>
            Хэрэглэгч – энэхүү нөхцөлийг хүлээн зөвшөөрөн Компанийн үйлчилгээг
            авч буй хувь хүнболон хуулийн этгээд
        </p>
    </li>
    <li>
        <p>
            MAZ.mn үйлчилгээ – сайтын туслалцаатай Компанийн үзүүлж буй
            төлбөргүй болон төлбөртэй үйлчилгээ.
        </p>
    </li>
</ul>
<p>
    1.4. Хэрэв Хэрэглэгч нь энэхүү нөхцөлийг хүлээн зөвшөөрөөгүй бол сайтыг
    орхин, аппликейшнийг устгахыг зөвлөж байна. MAZ.mn сайтын үйлчилгээг
    Хэрэглэгч авахыг энэхүү үйлчилгээний нөхцөлөөр зохицуулна. MAZ.mn -ээр
    үйлчлүүлснээр Хэрэглэгч энэхүү нөхцөлтэй танилцаж, хүлээн зөвшөөрсөн гэж
    ойлгоно.
</p>
<p>
    1.5. MAZ.mn дэх аль нэг үйлчилгээг ашиглаж эхлэх, аппликэйшн суулгах эсвэл
    бүртгүүлснээр Хэрэглэгч нь үйлчилгээний нөхцөлийг бүрэн эхээр нь хүлээн
    зөвшөөрсөнд тооцно. Хэрэв Хэрэглэгч энэхүү нөхцөлийн аль нэг заалтыг хүлээн
    зөвшөөрөөгүй тохиолдолд MAZ.mn -ийн үйлчилгээг авах эрхгүй болно.
</p>
<p>
    1.6. Компани нь интернет Хэрэглэгчдэд тус нөхцөлийн дагуу үйлчилгээг
    ашиглахыг санал болгож байна.
</p>
<p>
    1.7. Хэрэглэгчдийн дунд явагдаж буй бүх хэлэлцээр Компанийн оролцоогүйгээр
    явагддаг болно. Компани нь зар байршуулах худалдааны платформоор л хангадаг
    болно.
</p>
<p align="left">
    <strong>2. Талуудын эрх үүрэг</strong>
</p>
<p align="left">
    2.1. Компанийн үйлчилгээг ашиглан нэвтрэн үзэх боломжтой дизайны элемент,
    текст, график, дүрслэл, видео, компьютерын программ, мэдээллийн бааз, дуу
    хөгжим, дуу, бусад объект, түүнчлэн үйлчилгээний цахим хуудсанд байрлуулсан
    ямар нэгэн агуулга нь Компанийн, Хэрэглэгчдийн болон бусад эрх эзэмшигчийн
    онцгой эрх болно.
</p>
<p align="left">
    2.2.Агуулга болон үйлчилгээний бусад элементүүдийг зөвхөн санал болгосон
    үйл ажиллагааны хүрээнд ашиглах боломжтой юм. Сайтын байрлуулсан ямар нэгэн
    агуулгыг зохиогчийн эрх эзэмшигчээс урьдчилан зөвшөөрөлгүйгээр өөрөөр
    ашиглаж болохгүй болно. Үүнд: дахин боловсруулах, хуулбарлах, түгээх, г.м.
    зүйл багтана.
</p>
<p align="left">
    2.3.Хэрэглэгчийн оруулсан мэдээллийг нийтлэх эрхийг Компанид олгох үүднээс
    Хэрэглэгч нь оруулсан мэдээллийн бүх агуулгын ашиглах, нийтлэх, хуулбарлах,
    хувилах, олон нийтийн мэдээлэл дамжуулах хэрэгслээр түгээх эрхийг Компанид
    хугацаагүй, буцалтгүй, онцгой бус хэлбэрээр олгож байгаа болно. Дээр
    дурдсан эрх нь ямар нэгэн цалин хөлс, урамшуулалгүйгээр үнэгүй олгогдоно.
    Энэ тохиолдолд зард байрлуулсан мэдээллийн өмчийн эрх нь Хэрэглэгчид байна.
</p>
<p align="left">
    2.4.Сайтын үйлчилгээг ашигласнаар Хэрэглэгч нь өөрийн оруулсан зар дахь
    мэдээллийн хариуцлагыг дангаар үүрнэ.
</p>
<p align="left">
    2.5.Хэрэглэгчийн бичгээр өгсөн зөвшөөрлийн дагуу аль эсвэл холбогдох хууль
    тогтоомжийн дагуу Хэрэглэгчийн хувийн мэдээллийг гуравдагч этгээдэд олгоно.
</p>
<p align="left">
    2.6.Энэхүү нөхцөлийг зөрчсөн дурын зарыг Компани нь буцаах, устгах болон
    шилжүүлэх эрхтэй.
</p>
<p align="left">
    2.7.Хэрэглэгч нь сайтын ажиллагаатай холбоотой санал гомдлоо “Санал хүсэлт,
    сэтгэгдэл” болон “Гомдол” хэсгүүдээр дамжуулан илэрхийлэх эрхтэй. Санал
    гомдолтой ажлын 2 өдрийн дотор танилцана.
</p>
<p align="left">
    2.8.Компани нь Хэрэглэгчийн оруулсан зар бүхий мэдээллийг холбогдох зургийн
    хамт Сайтын сурталчилгааны зорилгоор нийтлэх эрхтэй. Үүнд Хэрэглэгчийн
    зөвшөөрөл шаардагдахгүй бөгөөд ямар нэгэн мөнгөн урамшуулал Хэрэглэгчид
    олгогдохгүй болно.
</p>
<p align="left">
    <a name="2"></a>
    <a name="3"></a>
    <a name="4"></a>
    2.9.Компани нь Хэрэглэгчийн оруулсан зар сурталчилгаа үнэн зөв болохыг
    нотлох баримтыг Хэрэглэгчээс шаардах эрхтэй.
</p>
<p align="left">
    <strong>3.Үйлчилгээний төлбөр</strong>
</p>
<p align="left">
    3.1.Хэрэглэгч нь төлбөрт үйлчилгээг сайтаас болон аппликейшнээр дамжуулан
    авах боломжтой.
</p>
<p align="left">
    3.2.Хэрэглэгч нь төлбөрт үйлчилгээг захиалахаас өмнө, төлбөрийн нөхцөлтэй
    анхлан танилцах үүрэгтэй.
</p>
<p align="left">
    3.3.Үйлчилгээний төлбөрийг сайт дээр заасны дагуу хийнэ.
</p>
<p>
    <a name="5"></a>
    <br/>
</p>
<p align="left">
    <strong>4.Компанийн хариуцлагын хязгаарлалт</strong>
</p>
<p align="left">
    4.1.Сайтын үйлчилгээг ашигласнаар, Хэрэглэгч нь өөрийн эрсдэлийг үнэлэн бүх
    эрсдэлийг үүрнэ. Хэрэглэгчдийн бичсэн зарын текстийн утга агуулга, сайтын
    холбоос, зарын тайлбарт компани хариуцлага үүрэхгүй болно.
</p>
<p align="left">
    4.2.Компани нь Хэрэглэгчдийн хоорондын худалдан авалтын зохион байгуулагч
    биш болно. Сайт нь Хэрэглэгчдийн хуулиар зөвшөөрөгдсөн бараа, үйлчилгээг
    хүссэн үедээ, дурын газраас, хүссэн үнээр худалдах болон худалдан авах
    боломжийг бусад Хэрэглэгчдэд олгох зорилготой худалдааны харилцаа холбооны
    платформ юм.
</p>
<p align="left">
    4.3.Компани нь Хэрэглэгчдийн зард орсон мэдээллийн бодит байдлыг хянах
    боломжгүй юм. Компани нь хэлцэл хийгч талуудын аливаа нэгэн зохисгүй зан,
    эсвэл гарсан хохиролд хариуцлага хүлээхгүй болно.
</p>
<p align="left">
    4.4.Компани нь Хэрэглэгчийн зард санал болгож буй тээврийн хэрэгсэлд
    хариуцлага үүрэхгүй. Хэрэглэгчдийн хооронд гарсан маргаан, зөрчил нь
    Компанийн оролцоогүйгээр Хэрэглэгчдийн хооронд шийдвэрлэгдэнэ.
</p>
<p align="left">
    4.5.Гуравдагч этгээдийн хууль бусаар сайтад нэвтрэн Компанийн серверийг
    болон Хэрэглэгчдийн мэдээлэл ашиглах, түүнчлэн сайтаар дамжуулан вирус,
    Trojan, г.м. тараасан тохиолдолд хариуцлага хүлээхгүй.
</p>
<p align="left">
    4.6.Зард байршсан тээврийн хэрэгслийн чанар, аюулгүй байдал, хуулиар
    зөвшөөрөгдсөн байдал болон тайлбартайгаа нийцэх асуудал Компанийн хяналтаас
    гадуур байгаа болно.
</p>
<p align="left">
    4.7.Хэрэглэгч сайтыг ашиглаж байх үедээ анхаарал болгоомжтой байхыг компани
    зөвлөж байна. Зарын эзэн нь дурдсан тээврийн хэрэгсэлгүй эсвэл өөр хүний
    дүр эсгэж байж болохыг анхаарна уу. Хэрэглэгч сайтыг хэрэглэснээр дээрх
    эрсдэлийг болон бусад Хэрэглэгчийн үйлдэлд компани хариуцлага үүрэхгүй
    болохыг хүлээн зөвшөөрсөнд тооцно.
</p>
<p align="left">
    4.8.Сайтын Хэрэглэгч нь өөрийн хийсэн үйлдэлд бүрэн хариуцлага үүрнэ.
</p>
<p align="left">
    4.9.Хэрэглэгчийн өөрийн эрх ашгийг өөр нэгэн Хэрэглэгч зөрчсөн тохиолдлыг
    Хэрэглэгч компанид мэдэгдэх эрхтэй. Хэрэглэгчийн гомдол бодит болох нь
    тогтоогдвол Компани нь өөрийн үзсэнээр холбогдох зарыг устгах эрхтэй.
</p>
<p align="left">
    4.10.Сайтыг буруу хэрэглэснээс гарсан хохирлыг компани хариуцахгүй болно.
</p>
<p align="left">
    <a name="6"></a>
    <strong>5.Үйлчилгээний нөхцөлийн хамрах хугацаа</strong>
</p>
<p align="left">
    5.1.Энэхүү нөхцөлийг Хэрэглэгч сайт ашиглаж эхэлсэн үеэс мөрдөх бөгөөд
    энэхүү нөхцөл нь хугацаагүй болно.
</p>
<p align="left">
    5.2.Хэрэглэгч нь өөрийн бүртгэлийг сайтаас компанид урьдчилан мэдэгдэлгүй,
    тайлбар өгөлгүй хасах эрхтэй.
</p>
<p align="left">
    5.3.Хэрэв компани 7 дугаар бүлэгт заасанчлан Үйлчилгээний нөхцөлд нэмэлт
    өөрчлөлтөөр оруулсан аль нэг заалтыг Хэрэглэгч хүлээн зөвшөөрөхгүй байгаа
    тохиолдолд Хэрэглэгч сайтын үйлчилгээг ашиглахаа дуусгавар болгох үүрэгтэй.
    Хэрэглэгч сайтыг ашигласан хэвээр байгаа тохиолдолд нэмэлт өөрчлөлтийг
    хүлээн зөвшөөрсөнд тооцно.
</p>
<p align="left">
    <a name="7"></a>
    <strong>6.Үйлчилгээний нөхцөлиийн нэмэлт өөрчлөлт</strong>
</p>
<p align="left">
    7.1.Компани нь урьдчилан мэдэгдэлгүйгээр үйлчилгээний нөхцөлд нэмэлт
    өөрчлөлт оруулж болно. Үйлчилгээний нөхцөлийн шинэ хувилбар доорх интернет
    хаяг дээр байршсан өдрөөс даган мөрдөгдөнө. Үйлчилгээний нөхцөлийн хүчин
    төгөлдөр найруулга <a href="https://www.maz.mn/register/" target="_blank">https://www.maz.mn/about/rules/</a>
    хаяг дээр байрлана.
</p>

                                </div>

                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" name="onlineUseTerm" id="onlineUseTerm" class="custom-control-input" required>
                                    <label class="custom-control-label" for="onlineUseTerm">Зар нийтлэх журам</label>
                                </div>

                                <div class="terms-text">
<p align="left">
    1. Хэрэглэгч нь сайтын заасан хуудсыг бөглөснөөр өөрийн санал болгож
    тээврийн хэрэгслийг сайтад зарлан нийтлэх бүрэн эрхтэй.
</p>
<p align="left">
    2. Хэрэглэгч сайтын гишүүнээр саадгүй бүртгүүлэх бүрэн эрхтэй бөгөөд
    бүртгэлд өөрт ирсэн нууц кодоороо сайтад нэвтэрч, сайтын үйлчилгээг авах
    эрхтэй.
</p>
<p align="left">
    3. Сайтын үйлчилгээг авснаар энэхүү үйлчилгээний нөхцөлд заасан дүрэм
    журмыг заавал мөрдөх шаардлагыг хүлээн зөвшөөрсөнд тооцно.
</p>
<p align="left">
    4. Хэрэглэгч сайт уруу ордог өөрийн нууц кодоо нууцалж, нууц кодтой
    холбоотой бүх асуудлын хариуцлагыг өөрөө үүрнэ. Хэрэглэгч зөвхөн өөрийн
    емэйл хаяг, нууц код ашиглан сайтын үйлчилгээг авах эрхтэй.
</p>
<p align="left">
    5. Нэг Хэрэглэгч нь (хувь хүн болон хуулийн этгээд) нэг л бүртгэлтэй байна.
    Нэгээс илүү бүртгэлтэй байх нь хориотой тул автомат системээр тогтоогдсон
    давхар бүртгэлүүд түр хаагдах болон түгжигдэх болно.
</p>
<p align="left">
    6. Хэрэглэгч сайт уруу ордог өөрийн нууц кодоо нууцалж, гуравдагч этгээдэд
    өгөхгүй байх үүрэгтэй.
</p>
<p align="left">
    7. Зар нийтэлж буй Хэрэглэгч нь өөрийн тээврийн хэрэгслийн мэдээллийг
    сайтын журмын дагуу нийтлэх эрхтэй. Зар нийтэлснээр зарын эзэн нь холбогдох
    хууль тогтоомжийн дагуу нийтэлсэн тээврийн хэрэгслийг худалдах эрхтэй гэж
    ойлгоно.
</p>
<p align="left">
    8. Зарын эзэн нь худалдаж буй тээврийн хэрэгслийн чанар, аюулгүй байдал,
    хууль дүрэмд харшлахгүй байх тал дээр бүрэн хариуцна.
</p>
<p align="left">
    9. Худалдан авагч, захиалагчийн талаас тээврийн хэрэгслийн баталгаат
    хугацаа, чанар, аюулгүйн байдлыг, түүнчлэн санал болгосон тээврийн
    хэрэгслийн гэрчилгээг нэхэмжилсэн тохиолдолд зарын эзэн буюу худалдагчийн
    талаас батлан дааж, тэдний хүсэлтийг биелүүлэх үүрэгтэй.
</p>
<p align="left">
    10. Зарын эзэн нь өөрийн зарлаж буй тээврийн хэрэгслийн дэлгэрэнгүй
    мэдээллийг мэддэг байх шаардлагатай бөгөөд буруу мэдээлэл олсон тохиолдолд
    нэмэлт мэдээллийг зард засвар оруулан нэмэх үүрэгтэй.
</p>
<p align="left">
    11. Зарын эзэн нь өөрийн тээврийн хэрэгслийг идэвхтэй сурталчлах эрхтэй
    бөгөөд өрсөлдөгч худалдагчдад саад болохгүй байх үүрэгтэй. Үүнд эдгээр
    зүйлсийг хориглоно:
</p>
<p align="left">
    · Өөр бусад зарын самбар, худалдаалах талбай, интернет дуудлага худалдаа
    болон интернет дэлгүүрийн талаарх мэдээлэл.
</p>
<p align="left">
    12. Компани нь нийтлэгдсэн зарын хугацааг сунгах, зарын байршлыг өөрчлөх
    эрхтэй. Хэрэв зарын эзэн нь сайтын дотоод журам болон хууль дүрмийг зөрчиж,
    алдаатай зар нийтэлсэн тохиолдолд Компани зар нийтлэхийг хориглож, устгах
    эрхтэй.
</p>
<p align="left">
    13. Зар оруулахад дараах зүйлсийг хориглоно:
</p>
<ul>
    <li>
        <p align="left">
            Нэг хаягаас ижил зар нийтлэх;
        </p>
    </li>
    <li>
        <p align="left">
            Зарын утга санаа давхцах;
        </p>
    </li>
    <li>
        <p align="left">
            Өөр хоёр хаягаас нэг зарыг хуулж зар оруулах;
        </p>
    </li>
    <li>
        <p align="left">
            Зар оруулахдаа хайж байна, худалдаж авна, санал хүлээж байна гэж
            зарлах;
        </p>
    </li>
    <li>
        <p align="left">
            Зарын гарчиг, утга агуулга нь зарын бүлэгт тохирохгүй байх;
        </p>
    </li>
    <li>
        <p align="left">
            Зарын гарчигт цэг тэмдэг болон өөр бусад тэмдэгтүүд бичих;
        </p>
    </li>
    <li>
        <p align="left">
            Зарын гарчиг, оруулсан зураг, зарын тайлбар нь хоорондоо утга
            санааны зөрчилтэй байх;
        </p>
    </li>
    <li>
        <p align="left">
            Нэг зар дээр хэд хэдэн тээврийн хэрэгслийг зэрэг зарлах;
        </p>
    </li>
    <li>
        <p align="left">
            Зар нийтлэхдээ өөр бусад сайтын холбоос (линк) болон MAZ.mn -ий
            холбоос бичиж оруулах;
        </p>
    </li>
    <li>
        <p align="left">
            Нийтэлж буй зарын утга, байршил нь тухайн зарлагчийн сайтад
            бүртгүүлсэн хотын байршлаас зөрөх.
        </p>
    </li>
</ul>
<p align="left">
    Зар нь сайтын админаар дамжин хянагдаж, шаардлага хангасан бол нийтлэгдэнэ.
</p>
<p align="left">
    15. Зар нийтлэх дүрэм
</p>
<p align="left">
    15.1. Зарлагчийн хувийн мэдээлэл
</p>
<ul>
    <li>
        <p align="left">
            Нэр бичих тайлбарт ямар нэгэн сайт, холбоо барих утасны дугаар,
            хаяг бичихгүй байх
        </p>
    </li>
    <li>
        <p align="left">
            Зарлагч нь нэрээ үнэн зөв, албан ёсны бүтэн нэрээ бичнэ
        </p>
    </li>
</ul>
<p align="left">
    15.2. Зарын гарчиг
</p>
<ul>
    <li>
        <p align="left">
            Зарын гарчигт зөвхөн зарлаж буй тээврийн хэрэгслийн үйлдвэр,
            загварыг бичнэ. Бусад мэдээллийг зарын тайлбар хэсэгт бичнэ. Гарчиг
            нь зарын тайлбартайгаа нийцэх ёстой.
        </p>
    </li>
    <li>
        <p align="left">
            Үндэслэлгүй том үсэг, таслал цэг тэмдэг ашиглахыг хориглоно.
        </p>
    </li>
    <li>
        <p align="left">
            Зарын гарчиг хэсэгт ямар нэгэн сайт, холбоо барих утасны дугаар,
            хаяг оруулахыг хориглоно.
        </p>
    </li>
    <li>
        <p align="left">
            Олон нийтийн анхаарал татсан үгийг ашиглахгүй байх. Жишээ нь:
            Яаралтай, Анхаараарай, Урамшуулалтай, Хямдралтай г.м.
        </p>
    </li>
</ul>
<p align="left">
    15.3.Зарын тайлбар
</p>
<ul>
    <li>
        <p align="left">
            Зарын тайлбарт үндэслэлгүй цэг тэмдэг, том үсэг ашиглахгүй байх
        </p>
    </li>
    <li>
        <p align="left">
            Зарлаж буй бараа, үйлчилгээ, ажлын байр буюу оруулсан зургийн тухай
            тайлбарлан бичнэ.
        </p>
    </li>
    <li>
        <p align="left">
            Зарын тайлбар нь зөвхөн тээврийн хэрэгслийн тухай тодорхой
            мэдээллийг оруулах ба өөр бусад дэлгэрэнгүй мэдээлэл, сурталчилж
            тайлбарлахгүй болно. Зарын тайлбарт тээврийн хэрэгслийн хүргэлтийн
            үйлчилгээний нөхцөлийг бичиж оруулахыг зөвшөөрнө.
        </p>
    </li>
    <li>
        <p align="left">
            Зарын тайлбарт зарлаж буй бараанаас гадна өөр бусад тээврийн
            хэрэгслийг дурдахыг хориглоно.
        </p>
    </li>
    <li>
        <p align="left">
            Зарын тайлбарт ямар нэгэн сайт, холбоо барих утасны дугаар, хаяг
            оруулахыг хориглоно.
        </p>
    </li>
</ul>
<p align="left">
    15.4.Зарын фото зураг
</p>
<ul>
    <li>
        <p align="left">
            Зураг нь зарын утга агуулгатай нийцсэн байх ёстой.
        </p>
    </li>
    <li>
        <p align="left">
            Фото зураг нь ямар нэгэн тамгатай тохиолдолд ашиглахыг хориглоно.
        </p>
    </li>
    <li>
        <p align="left">
            Фото зурагт нь албан байгууллагын нэр болон лого тэмдэгтэй байхыг
            хориглоно.
        </p>
    </li>
    <li>
        <p align="left">
            Зурагт бусдын анхаарал татсан текст оруулж засахгүй байх. Жишээ нь:
            Яаралтай, Анхаараарай, Хямдарсан гэх мэт. Мөн түүнчлэн зурагт
            засвар оруулж элдэв хэв маягийн фон, өнгийн хувиргалт, хүрээ хийсэн
            тохиолдолд зарын зургийг хүчингүйд тооцно.
        </p>
    </li>
    <li>
        <p align="left">
            Зурагт холбоо барих хаяг оруулахгүй байхыг хатуу анхаарна уу.
        </p>
    </li>
</ul>
<p align="left">
    15.5.Үнэ
</p>
<ul>
    <li>
        <p align="left">
            Зөвхөн санал болгож буй тээврийн хэрэгслийн үнийг бичнэ.
        </p>
    </li>
    <li>
        <p align="left">
            Хэрэв үнийн дүн, урьд нь байснаасаа хямдарч буурсан тохиолдолд
            хямдруулсан шалтгаан буюу тээврийн хэрэгсэл муудаж хуучирсан гэх
            мэт бусад тайлбарыг зарын тайлбар хэсэгт бичиж оруулна.
        </p>
    </li>
    <li>
        <p align="left">
            Тээврийн хэрэгслийн үнийг зарын гарчигт оруулахгүй байх. Үнийн дүнг
            заасан тайлбарт бичнэ.
        </p>
    </li>
</ul>
<p align="left">
    Компани нь эрх бүхий байгууллага болон холбогдох засгийн газрын
    байгууллагын шаардлагын дагуу зарыг устгах эрхтэй. Компани нь өөрийн
    үзсэнээр зарыг нийтийн ёс суртахуунгүй гэж үзвэл устгах эрхтэй. Чанарын
    шаардлага хангаагүй, сайтын зарын дотоод дүрмийг зөрчсөн, улсын хууль
    цаазад харшилсан зарыг сайтын зүгээс устгах бүрэн эрхтэй.
</p>
<p align="left">
    16. Сайтын удирдлага буюу Компанийн эрх, үүрэг:
</p>
<ul>
    <ul>
        <li>
            <p align="left">
                Хэрэглэгч буюу зар нийтлэгчийн өөрийнх нь бичиж найруулсан
                зарын утга агуулгад өөрчлөлт оруулахгүй байх.
            </p>
        </li>
        <li>
            <p align="left">
                Хэрэв зарын утга агуулга нь сайт дахь өөр нэг бүлэгт илүү
                тохиромжтой байгаа тохиолдолд зарын байршлыг өөрчлөн,
                тохиромжит бүлэгт нийтлэх эрхтэй.
            </p>
        </li>
        <li>
            <p align="left">
                Хэрэв нийтлэгдсэн зар нь тухайн оруулсан бүлэгт тохироогүй,
                сайтын дотоод дүрмийг зөрчсөн тохиолдолд устгах эрхтэй. Мөн
                түүнчлэн нэг Хэрэглэгчээс нийтлэгдэх зарын тоог хязгаарлах
                эрхтэй.
            </p>
        </li>
        <li>
            <p align="left">
                Зарлаж буй тээврийн хэрэгслийн мэдээлэл хуурамч, байж боломжгүй
                тохиолдолд зарыг хүчингүйд тооцно. Тэр тусмаа тухайн тээврийн
                хэрэгслийн үнэ нь хэт худал үнэлэгдсэн байвал зар устгагдана.
                Тээврийн хэрэгслийн үнээ үнэн зөв, бодитойгоор үнэлнэ.
            </p>
        </li>
        <li>
            <p align="left">
                Зарын гарчиг нь зарын тайлбартай уялдаа холбоотой, утга нэгтэй
                байх ёстой ба гарчигт зарлагчийн холбоо барих утасны дугаар,
                хаяг бичигдэхгүй байх ёстой.
            </p>
        </li>
        <li>
            <p align="left">
                Зарын зураг нь зарын гарчиг, зарын тайлбартай шууд холбоотой
                зураг байх ёстой. Зурагт зөвхөн санал болгож буй объектын дүрс
                байна. Интернет сайтаас хуулсан, чанарын шаардлага хангаагүй
                зургийг сайт нийтлэхгүй болно.
            </p>
        </li>
        <li>
            <p align="left">
                Хэрэглэгч хоорондын харилцаа холбоог илүү хөнгөвчлөхийн тулд
                сайт нь Хэрэглэгчийн холбоо барих хаяг, утасны дугаарын
                мэдээллийг бусад Хэрэглэгчдэд хязгаарлаж болно. Бусдын
                мэдээллийг ашиглах эрхийг энэхүү үйлчилгээний нөхцөлөөр
                зохицуулна.
            </p>
        </li>
        <li>
            <p align="left">
                Хэрэглэгчийн бичсэн зарын утга агуулга, сайтын холбоос, зарын
                тайлбарт сайт хариуцлага үүрэхгүй болно.
            </p>
        </li>
        <li>
            <p align="left">
                Хориотой бус, улсын хууль цаазад харшлаагүй, сайтын хориотой
                барааны жагсаалд ороогүй бүх бараа бүтээгдэхүүн, үйлчилгээ,
                ажлын байрын зарыг нийтэлж болно.
            </p>
        </li>
    </ul>
</ul>
<p align="left">
    17. Зарыг дараахь шалтгаануудаар устгана:
</p>
<p align="left">
    Энэхүү нөхцөлийг Хэрэглэгч зөрчсөн гэж үзвэл Компани нь Хэрэглэгчийн
    нийтэлсэн зарыг доорх шалтгаанаар устгах эрхтэй:
</p>
<ul>
    <ul>
        <li>
            <p align="left">
                Тухайн Хэрэглэгчид нийтлэгдсэн тээврийн хэрэгсэлтэй нь ижил
                төстэй зар байх
            </p>
        </li>
        <li>
            <p align="left">
                Зарын оруулсан мэдээлэл нь энэхүү үйлчилгээний нөхцөл, зар
                нийтлэх журам болон холбогдох хууль тогтоомж зөрчих
            </p>
        </li>
        <li>
            <p align="left">
                Зард агуулагдах мэдээлэл нь бодит бус байх
            </p>
        </li>
        <li>
            <p align="left">
                Зарын гарчиг нь зарын мэдээлэл тайлбартай холбогдолгүй байх
            </p>
        </li>
        <li>
            <p align="left">
                Зарын гарчигт олон тооны цэг таслал, анхааруулгын тэмдэг, том
                үсэгтнүүд ашиглан оруулсан байх
            </p>
        </li>
        <li>
            <p align="left">
                Зарын гарчиг болон тайлбарын зурагт интернет хаяг буюу бусад
                сайтын холбоос бичигдсэн байх
            </p>
        </li>
        <li>
            <p align="left">
                Зураг нь зарын утга агуулгатай нийцээгүй, шууд хамааралгүй байх
            </p>
        </li>
        <li>
            <p align="left">
                Зураг нь интернет сайтаас хуулсан, абстракт, үл ойлгогдох
            </p>
        </li>
        <li>
            <p align="left">
                Зурагт ямар нэгэн хаяг оруулсан байх (бусад сайтын холбоос,
                е-мэйл, утасны дугаар, Skype, Facebook хаяг, г.м.)
            </p>
        </li>
        <li>
            <p align="left">
                Зургийн чанар буюу пиксел муу, сурталчилж буй бараа зураг дээрх
                бусад бараанаас ялгарч харагдахгүй байх
            </p>
        </li>
        <li>
            <p align="left">
                Тухайн зарын бүлэгт үл таарах
            </p>
        </li>
        <li>
            <p align="left">
                Хэрэглэгчдийн зүгээс болон бусад байгууллагаас оюуны өмчийн
                эрхийг зөрчсөн гэсэн гомдол ирэх, мөн холбогдох засгийн газрын
                байгууллагын шаардлагын дагуу
            </p>
        </li>
        <li>
            <p align="left">
                Бусад Хэрэглэгчдийн сурталчлах эрх зөрчигдсөн талаарх
                үндэслэлтэй гомдол ирэх.
            </p>
        </li>
    </ul>
</ul>

                                </div>

                                <!-- NEXT PREV BUTTON START -->
                                <div style="float:right;">
                                    <button id="step1Next" class="btn btn-danger btn-round shadow-red px-5 py-2" type="button" disabled>Дараах</button>
                                </div>
                            </div>
                            <div id="step-2" class="tab-pane">
                                <input type="text" name="username" id="username" value="" hidden>

                                <div class="row">

                                    <div class="col-md-7">
                                        <div class="form-group col-md-12 d-inline-block align-top">
                                            <div class="profile-upload">
                                                <div class="circle">
                                                    <img class="profile-pic" src="">
                                                </div>
                                                <div class="upload-image">
                                                    <div class="btn btn-sm btn-primary upload-button" id="image">Зураг</div>
                                                    <input class="btn btn-primary file-upload" type="file" name="avatar" id="avatar" accept="image/*"/>
                                                </div>
                                            </div>
                                        <!-- <div class="card-body bg-white grid-radio dealer">
                                    <div class="cd-radio">
                                        <input type="radio" id="userType1" name="groupId" value="{{ \App\Group::where('title', 'Member')->first()->id }}" checked onclick="userType(1)"  class="custom-control-input">
                                        <label class="custom-control-label " for="userType1"> <img src="{{ asset('car-web/img/icons/sedan.svg') }}"
                                            alt=""><span>Хувь хүн</span>
                                        </label>
                                    </div>
                                    <div class="cd-radio">
                                        <input type="radio" id="userType2" name="groupId" value="{{ \App\Group::where('title', 'Auto Dealer')->first()->id }}" onclick="userType(2)" class="custom-control-input">
                                        <label class="custom-control-label" for="userType2"> <img src="{{ asset('car-web/img/icons/suv.svg') }}" alt=""><span>Диллер</span>
                                        </label>
                                    </div> -->

                                    </div>
                                        <div class="form-group">
                                            <label for="email">И-мэйл:</label>
                                            <input type="text" name="email" id="email" maxlength="191" required class="form-control @error('email') is-invalid @enderror" placeholder="example@mail.com" value="{{ old('email') }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Нэр:</label>
                                            <input type="text" name="name" id="name" maxlength="191" required class="form-control @error('name') is-invalid @enderror" placeholder="Dorj Pagam" value="{{ old('name') }}">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Утасны дугаар</label>
                                            <div class="input-group">
                                                <input type="text" name="phone" id="phone" hidden>
                                                <input type="number" class="form-control" id="phoneNumber" placeholder="Утасны дугаар" style="width: 200px;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Нууц үг:</label>
                                            <input type="password" name="password" id="password" required class="form-control @error('password') is-invalid @enderror" placeholder="Нууц үг">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">Нууц үг давт:</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" required class="form-control" placeholder="Нууц үг давт">
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="social-login">
                                            <div class="social-login-title">
                                                Сошиал хаягаараа нэвтрэх
                                            </div>
                                            <a href="{{ route('login.provider', 'facebook') }}" class="btn btn-facebook btn-round btn-block my-2 py-3 shadow-soft-blue btn-icon-left"><i class="fab fa-facebook-f"></i> Facebook</a>
                                            <a href="{{ route('login.provider', 'google') }}" class="btn btn-light btn-round btn-block my-2 py-3 shadow-soft-blue btn-icon-left"><i class="fab fa-google"></i> Gmail</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- NEXT PREV BUTTON START -->
                                <div style="float:right;">
                                    <button class="btn btn-light btn-round px-5 py-2 mr-3" type="button" id="step2Prev">Өмнөх</button>
                                    <button class="btn btn-danger btn-round shadow-red px-5 py-2" type="button" id="step2Next">Бүртгүүлэх</button>
<!--                                    <button id="userTypes2" class="btn btn-danger btn-round shadow-red px-5 py-2">Бүртгүүлэх</button>-->
                                    <button id="userRegister" class="btn btn-danger btn-round shadow-red px-5 py-2" hidden type="submit">Бүртгүүлэх</button>
                                </div>
                            </div>
                            <div id="step-3" class="tab-pane">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="form-group col-md-12 d-inline-block align-top">
                                            <div class="profile-upload">
                                                <div class="circle">
                                                    <img class="profile-pic-d" src="">
                                                </div>
                                                <div class="upload-image">
                                                    <div class="btn btn-sm btn-primary upload-button" id="dealerImage">Дилер зураг</div>
                                                    <input class="btn btn-primary file-upload" type="file" name="retailImage" id="dealerAvatar" accept="image/*"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="companyName">Байгууллагын нэр</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="companyName" id="companyName" placeholder="Байгууллагын нэр">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Байгууллагын хаяг</label>
                                            <div class="input-group">
                                                <textarea type="text" class="form-control" name="address" id="address" placeholder="Байгууллагын хаяг"></textarea>
                                            </div>
                                        </div>
<!--                                        <div class="form-group">-->
<!--                                            <label for="website">Веб хуудас</label>-->
<!--                                            <div class="input-group">-->
<!--                                                <input type="text" class="form-control" name="website" id="website" placeholder="Веб хуудас">-->
<!--                                            </div>-->
<!--                                        </div>-->
                                        <div class="form-group">
                                            <label for="schedule">Цагын хуваарь</label>
                                            <div class="input-group">
                                                <textarea type="text" class="form-control" name="schedule" id="schedule" placeholder="Цагын хуваарь"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Танилцуулга</label>
                                            <div class="input-group">
                                                <textarea type="text" class="form-control" name="description" id="description" placeholder="Танилцуулга"></textarea>
                                            </div>
                                        </div>
                                       <div class="form-group">
                                           <label for="retailPhone">Утасны дугаар</label>
                                           <div class="input-group">
                                                <input type="number" name="retailPhone" id="retailPhone" class="form-control" placeholder="Утасны дугаар" style="width: 200px;">
                                           </div>
                                       </div>
                                    </div>
                                </div>

                                <!-- NEXT PREV BUTTON START -->
                                <div style="float:right;">
                                    <button class="btn btn-light btn-round px-5 py-2 mr-3" type="button" id="step3Prev">Өмнөх</button>
                                    <button class="btn btn-danger btn-round shadow-red px-5 py-2" type="submit">Бүртгүүлэх</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@include('themes.car-web.includes.loader')
@endsection

@section('script')
{{-- Step Wizard --}}
<script>
    $(document).ready(function() {
        $(".step-process a").each(function(index) {
            $(this).on('click', function () {
                for (var i = index; i>=1; i--) {
                    $('#tab-step-'+i).parent().removeClass('active');
                    $('#tab-step-'+i).parent().addClass('done');
                }
                for (var i = index+1; i<=3; i++) {
                    $('#tab-step-'+i).parent().removeClass('active');
                    $('#tab-step-'+i).parent().removeClass('done');
                }
                $(this).parent().addClass('active');

                $('#steps > .active').removeClass('active').removeClass('show');
                $("#step-"+(index+1)).addClass('active').addClass('show');
            });
        });

        $("#step1Next").click(function () {
            $("#tab-step-2").trigger('click');
        });
        $("#step2Prev").click(function () {
            $("#tab-step-1").trigger('click');
        });
        $("#step3Prev").click(function () {
            $("#tab-step-2").trigger('click');
        });
    });
    var regType=1;
    function userType(type) {
        if(type===1){
            $( "#step-3id" ).attr( "hidden","true" );
            $( "#step2Next" ).text( "Бүртгүүлэх" );
            //$( "#userTypes2" ).removeAttr( "hidden" );
        }
        else if(type===2){
            $( "#step-3id" ).removeAttr( "hidden" );
            $( "#userTypes2" ).text( "Дараах" );
            //$( "#step2Next" ).removeAttr( "hidden" );
        }
        regType=type;
    }
</script>

{{-- Step 1 Validation --}}
<script>
    $(document).ready(function () {
        var termsOfCondition = $("#termsOfCondition");
        var onlineUseTerm = $("#onlineUseTerm");

        var validate = function () {
            if (termsOfCondition.prop('checked') && onlineUseTerm.prop('checked')) {
                $("#step1Next").prop('disabled', false);
            } else {
                $("#step1Next").prop('disabled', true);
            }
        }

        termsOfCondition.change(validate);
        onlineUseTerm.change(validate);
    });
</script>

{{-- Step 2 Validation --}}
<script>
    $(document).ready(function () {
        var emailField = $('#email');
        var usernameField = $('#username');
        var nameField = $('#name');
        var passwordField = $('#password');
        var passwordConfirmationField = $('#password_confirmation');
        var onEmailChange = function () {
            usernameField.val(emailField.val());
        };
        var validateEmail = function (email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }
        var invalidFeedback = function (message) {
            if (message != null) {
                return $('<span class="invalid-feedback" role="alert">'+message+'</span>');
            }
        }
        var validFeedback = function (message) {
            if (message != null) {
                return $('<span class="valid-feedback" role="alert">'+message+'</span>');
            }
        }
        var showValidation = function (status = 1, message = null, element) {
            // status == 1 - Successful validation
            // status == 0 - Validation is loading
            // status == -1 - Unsuccessful validation
            var formGroup = element.parent(".form-group");
            switch (status) {
                case 1:
                    element.addClass('is-valid');
                    formGroup.addClass('form-group-feedback');
                    formGroup.append(validFeedback(message));
                    break;
                case 0:
                    element.removeClass('is-valid');
                    element.removeClass('is-invalid');
                    formGroup.removeClass('form-group-feedback');
                    formGroup.find('.invalid-feedback').remove();
                    formGroup.find('.valid-feedback').remove();
                    break;
                case -1:
                    element.addClass('is-invalid');
                    formGroup.addClass('form-group-feedback');
                    formGroup.append(invalidFeedback(message));
                    break;
            }
        }
        var validate = function (e) {
            e.preventDefault();
            $("#demo-spinner").css({'display': 'block'});

            showValidation(0, null, emailField);
            showValidation(0, null, nameField);
            showValidation(0, null, passwordField);
            showValidation(0, null, passwordConfirmationField);

            if (validateEmail(emailField.val())) {
                $.getJSON('/ajax/user_exists?email=' + emailField.val(), function (data) {
                    if (!data.status) {
                        showValidation(1, 'И-мэйл боломжтой!', emailField);
                    } else {
                        showValidation(-1, 'Энэ и-мэйлээр өмнө нь бүртгүүлж байсан байна!', emailField);
                    }
                });
            } else {
                showValidation(-1, 'Зөв и-мэйл хаяг оруулна уу!', emailField);
            }

            if (nameField.val().length == 0) {
                showValidation(-1, 'Нэрээ оруулна уу!', nameField);
            } else {
                showValidation(1, null, nameField);
            }

            if (passwordField.val().length == 0) {
                showValidation(-1, 'Нууц үгээ оруулна уу!', passwordField);
            } else {
                if (passwordField.val() === passwordConfirmationField.val()) {
                    if (passwordField.val().length < 8) {
                        showValidation(-1, 'Нууц үг дор хаяж 8 тэмдэгтээс бүрдсэн байх ёстой', passwordField);
                        showValidation(-1, null, passwordConfirmationField);
                    } else {
                        showValidation(1, null, passwordField);
                        showValidation(1, null, passwordConfirmationField);
                    }
                } else {
                    showValidation(-1, 'Нууц үг таарахгүй байна', passwordField);
                    showValidation(-1, null, passwordConfirmationField);
                }
            }

            setTimeout(function () {
                if (emailField.hasClass('is-valid') && nameField.hasClass('is-valid') && passwordField.hasClass('is-valid') && passwordConfirmationField.hasClass('is-valid')) {
                    if(regType===1){
                        $("#userRegister").trigger('click');
                    }
                    else if(regType===2){
                        $("#tab-step-3").trigger('click');
                    }
                }
            }, 1000);
            $("#demo-spinner").css({'display': 'none'});
        };

        $('#email').change(onEmailChange).keyup(onEmailChange);
        $("#step2Next").click(validate);

        $("#step-2").find("input").each(function() {
            $(this).keydown(function(event) {
                if(event.keyCode == 13) {
                    event.stopPropagation();
                    event.preventDefault();
                    $("#step2Next").click();
                    return false;
                }
            });
        });
    });
</script>

{{-- Step 3 Validation --}}
<script>
    var readURL = function(input,no) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                if(no==1){$('.profile-pic').attr('src', e.target.result);}
                else if(no==2){$('.profile-pic-d').attr('src', e.target.result);}

            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#avatar").on('change', function(){
        readURL(this,1);
    });

    $("#dealerAvatar").on('change', function(){
        readURL(this,2);
    });

    $("#image").on('click', function() {
        $("#avatar").click();
    });
    $("#dealerImage").on('click', function() {
        $("#dealerAvatar").click();
    });
    $(document).ready(function () {
        var phoneNumber = $("#phoneNumber");
        var phone = $("#phone");
    
        var onPhoneChange = function () {
            phone.val(phoneNumber.val());
        }
    
        phoneNumber.change(onPhoneChange);
    
        onPhoneChange();
    });
</script>
@endsection
