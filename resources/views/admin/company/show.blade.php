@extends('themes.limitless.layouts.default')

@section('title', 'Company Detail')

@section('load')
@endsection

@section('pageheader')
    @include('admin.company.includes.pageheader')
@endsection

@section('content')

<div class="tab-content">

    <div class="tab-pane active" id="detail-tab">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <b class="col-form-label col-lg-2">Байгууллагын нэр</b>
                            <div class="col-lg-10">
                                <label class="col-form-label">{{$company->title}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <b class="col-form-label col-lg-2">Байгууллагын хаяг</b>
                            <div class="col-lg-10">
                                <label class="col-form-label">{{$company->metaValue('address')}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <b class="col-form-label col-lg-2">Веб хуудас</b>
                            <div class="col-lg-10">
                                <label class="col-form-label">{{$company->metaValue('website')}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <b class="col-form-label col-lg-2">Цагын хуваарь</b>
                            <div class="col-lg-10">
                                <label class="col-form-label">{{$company->metaValue('schedule')}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <b class="col-form-label col-lg-2">Танилцуулга</b>
                            <div class="col-lg-10">
                                <label class="col-form-label">{{$company->description}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <b class="col-form-label col-lg-2">Утасны дугаар</b>
                            <div class="col-lg-10">
                                <label class="col-form-label">{{$company->metaValue('retailPhone')}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <b class="col-form-label col-lg-2">Зураг</b>
                            <div class="col-lg-10">
                                <img class="profile-pic-d" style="width: 100%" src="{{ $company->metaValue('retailImage') }}">
                            </div>
                        </div>

                        <div class="text-right">
                            <a href="javascript:history.back()" class="btn btn-light">Back</a>
                            <a href="/admin/company/{{$company->id}}/edit" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table datatable-basic">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>E-mail</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>
                                        <div class="font-weight-semibold"><a href="/admin/users/{{$user->id}}">{{$user->username}}</a></div>
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td><span class="label label-success">{{$user->name}}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection

@section('script')
<script type="text/javascript">
    $(".styled, .multiselect-container input").uniform({
        radioClass: 'choice'
    });
</script>
@endsection
