@extends('themes.limitless.layouts.default')

@section('title', 'Edit Company')

@section('load')
<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/tables/datatables/datatables.min.js') }}"></script>
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
                <form class="form-horizontal" action="{{ route('admin.company.update', ['company' => $company->id]) }}" method="post" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}

                    <h3>Байгууллагын мэдээлэл</h3>

                    <div class="form-group">
                        <label for="companyName">Байгууллагын нэр</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="companyName" id="companyName" placeholder="Байгууллагын нэр" value="{{ $company->title }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Байгууллагын хаяг</label>
                        <div class="input-group">
                            <textarea type="text" class="form-control" name="address" id="address" placeholder="Байгууллагын хаяг">{{ $company->metaValue('address') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="website">Веб хуудас</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="website" id="website" placeholder="Веб хуудас" value="{{ $company->metaValue('website') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="schedule">Цагын хуваарь</label>
                        <div class="input-group">
                            <textarea type="text" class="form-control" name="schedule" id="schedule" placeholder="Цагын хуваарь">{{ $company->metaValue('schedule') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Танилцуулга</label>
                        <div class="input-group">
                            <textarea type="text" class="form-control" name="description" id="description" placeholder="Танилцуулга">{{ $company->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="retailPhone">Утасны дугаар</label>
                        <div class="input-group">
                            <input type="" name="retailPhone" id="retailPhone" class="form-control" placeholder="Утасны дугаар" value="{{ $company->metaValue('retailPhone') }}" style="width: 200px;">
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
                                <img class="profile-pic-d" style="width: 100%" src="{{ $company->metaValue('retailImage') }}">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h3>Байгууллагын диллерүүд</h3>

                    <table class="table datatable-basic">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Username</th>
                                <th>E-mail</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allusers as $user)
                            <tr>
                                <td><input type="checkbox" name="users[]" value="{{ $user->id }}" {{ ($users->contains($user->id)) ? 'checked' : '' }} /></td>
                                <td>
                                    <div class="font-weight-semibold"><a href="/admin/users/{{$user->id}}">{{$user->username}}</a></div>
                                </td>
                                <td>{{$user->email}}</td>
                                <td><span class="label label-success">{{$user->name}}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-right">
                        <a href="javascript:history.back()" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
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

$(function() {
    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
            orderable: false,
            width: '100px'
        }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });
    // Basic datatable
    $('.datatable-basic').DataTable();
});
</script>
@endsection
