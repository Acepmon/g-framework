@extends('themes.limitless.layouts.default')

@section('title', 'New Company')

@section('load')
@endsection

@section('pageheader')
    @include('admin.company.includes.pageheader')
@endsection

@section('content')

<!-- Grid -->
<div class="row">
    <div class="col-md-6">

        <!-- Horizontal form -->
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.company.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

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
                    <div class="form-group">
                        <label for="retailPhone">Утасны дугаар</label>
                        <div class="input-group">
                            <input type="" name="retailPhone" id="retailPhone" class="form-control" placeholder="Утасны дугаар" style="width: 200px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="retailPhone">Зураг</label>
                        <div class="profile-upload" style="text-align: center">
                            <div class="upload-image">
                                <input class="file-upload" type="file" name="retailImage" id="dealerAvatar" accept="image/*"/>
                            </div>
                            <br>
                            <div class="circle">
                                <img class="profile-pic-d" src="" style="width: 100%">
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="javascript:history.back()" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /horizotal form -->

    </div>
</div>
<!-- /grid -->


@endsection

@section('script')
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


$("#dealerAvatar").on('change', function(){
    readURL(this,2);
});
</script>
@endsection
