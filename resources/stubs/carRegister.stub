@extends('themes.car-web.layouts.default')

@section('title', 'Register')

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
                        <div class="step-process sp-3">
                            <div class='progress_inner_step active'>
                                <a class="nav-link" for='step-1' data-toggle="tab" href="#step-1" id="tab-step-1" role="tab" style="pointer-events: none;">Үйлчилгээний нөхцөл</a>
                            </div>
                            <div class='progress_inner_step'>
                                <a class="nav-link" for='step-2' data-toggle="tab" href="#step-2" id="tab-step-2" role="tab" style="pointer-events: none;">Нэвтрэх нэр & Нууц үг</a>
                            </div>
                            <div class='progress_inner_step' id="step-3id">
                                <a class="nav-link" for='step-3' data-toggle="tab" href="#step-3" id="tab-step-3" role="tab" style="pointer-events: none;">Нэмэлт мэдээлэл</a>
                            </div>
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

                                <div class="terms-text">
                                    <p>
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam officia commodi mollitia culpa ad explicabo facere. Obcaecati dignissimos nulla, esse labore culpa sint impedit dicta magni maxime velit, doloribus soluta, commodi vitae porro reprehenderit necessitatibus ad corporis! Mollitia maiores incidunt aut quos quod deleniti quaerat eius beatae tempora repellendus dolores sunt, fugit suscipit. Voluptate natus quaerat consequuntur alias iste sed animi nisi, cumque aliquam enim dolorum quas amet ullam rerum dignissimos dicta soluta repellat, non voluptas laborum minus fugit sunt omnis neque! Accusamus odio maiores maxime nemo dolorem neque molestiae aliquid delectus! Beatae accusamus tenetur architecto ipsum quidem error quibusdam.
                                    </p>
                                </div>

                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" name="onlineUseTerm" id="onlineUseTerm" class="custom-control-input" required>
                                    <label class="custom-control-label" for="onlineUseTerm">Онлайнаар ашиглах нөхцөл</label>
                                </div>

                                <div class="terms-text">
                                    <p>
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam officia commodi mollitia culpa ad explicabo facere. Obcaecati dignissimos nulla, esse labore culpa sint impedit dicta magni maxime velit, doloribus soluta, commodi vitae porro reprehenderit necessitatibus ad corporis! Mollitia maiores incidunt aut quos quod deleniti quaerat eius beatae tempora repellendus dolores sunt, fugit suscipit. Voluptate natus quaerat consequuntur alias iste sed animi nisi, cumque aliquam enim dolorum quas amet ullam rerum dignissimos dicta soluta repellat, non voluptas laborum minus fugit sunt omnis neque! Accusamus odio maiores maxime nemo dolorem neque molestiae aliquid delectus! Beatae accusamus tenetur architecto ipsum quidem error quibusdam.
                                    </p>
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
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox-cd col-5 display-inline-block mr-0 float-left">
                                                <input type="radio" name="groupId" value="{{ \App\Group::where('title', 'Member')->first()->id }}" class="custom-control-input" id="userType1" checked onclick="userType(1)" >
                                                <label class="custom-control-label" for="userType1">Хувь хүн</label>
                                            </div>
                                            <div class="custom-control custom-checkbox-cd col-5 display-inline-block mr-0 float-left">
                                                <input type="radio" name="groupId" value="{{ \App\Group::where('title', 'Auto Dealer')->first()->id }}" class="custom-control-input" onclick="userType(2)" id="userType2" >
                                                <label class="custom-control-label" for="userType2">Дилер</label>
                                            </div>
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
                                                <input type="text" name="cellPhone" id="cellPhone" hidden>
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
                                    <button class="btn btn-danger btn-round shadow-red px-5 py-2" type="button" hidden id="step2Next">Дараах</button>
                                    <button id="userTypes2" class="btn btn-danger btn-round shadow-red px-5 py-2" type="submit">Бүртгүүлэх</button>
                                </div>
                            </div>
                            <div id="step-3" class="tab-pane">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="form-group col-md-5 d-inline-block align-top">
                                            <div class="profile-upload">
                                                <div class="circle">
                                                    <img class="profile-pic" src="">
                                                </div>
                                                <div class="upload-image">
                                                    <div class="btn btn-sm btn-primary upload-button" id="image">Зураг</div>
                                                    <input class="btn btn-primary file-upload" type="file" name="avatar" id="avatar" accept="image/*"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5 d-inline-block align-top">
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
                                        <div class="form-group">
                                            <label for="website">Веб хуудас</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="website" id="website" placeholder="Веб хуудас">
                                            </div>
                                        </div>
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
<!--                                        <div class="form-group">-->
<!--                                            <label for="phone">Утасны дугаар</label>-->
<!--                                            <div class="input-group">-->
<!--                                                <input type="text" name="phone" id="phone" hidden>-->
<!--                                                <input type="number" class="form-control" id="phoneNumber" placeholder="Утасны дугаар" style="width: 200px;">-->
<!--                                            </div>-->
<!--                                        </div>-->
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

    function userType(type) {
        console.log(type)
        if(type===1){
            $( "#step-3id" ).attr( "hidden","true" );
            $( "#step2Next" ).attr( "hidden","true" );
            $( "#userTypes2" ).removeAttr( "hidden" );
        }
        else if(type===2){
            $( "#step-3id" ).removeAttr( "hidden" );
            $( "#userTypes2" ).attr( "hidden","true" );
            $( "#step2Next" ).removeAttr( "hidden" );
        }
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
                        showValidation(-1, 'Энэ и-мэйлээр өмнөн нь бүртгүүлж байсан байна!', emailField);
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
                    $("#tab-step-3").trigger('click');
                }
            }, 1000);
            $("#demo-spinner").css({'display': 'none'});
        };

        $('#email').change(onEmailChange).keyup(onEmailChange);
        $("#step2Next").click(validate);

        $("#step-2").find("input").each(function() {
            $(this).keydown(function(event) {
                console.log("CLICKED ENTER");
                if(event.keyCode == 13) {
                    console.log("CLICKED ENTER");
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
    // $(document).ready(function () {
    //     var phoneNumber = $("#phoneNumber");
    //     var phone = $("#phone");
    //
    //     var onPhoneChange = function () {
    //         phone.val(phoneNumber.val());
    //     }
    //
    //     phoneNumber.change(onPhoneChange);
    //
    //     onPhoneChange();
    // });
</script>
@endsection
