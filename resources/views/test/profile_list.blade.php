@extends('layouts.admin')

@section('load')

@endsection

@section('pageheader')
<div class="page-header-content">
    <div class="page-title">
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Profiles</span></h4>
    </div>

    <div class="heading-elements">
        <a href="#" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Button <b><i class="icon-menu7"></i></b></a>
    </div>
</div>

<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">Profiles</li>
    </ul>

    <ul class="breadcrumb-elements">
        <li><a href="#"><i class="icon-comment-discussion position-left"></i> Link</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-gear position-left"></i>
                Dropdown
                <span class="caret"></span>
            </a>

            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
            </ul>
        </li>
    </ul>
</div>
<!-- /page header -->
@endsection

@section('content')

<!-- Table -->

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Profiles datatable</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><form action="/profiles/create"><button type="submit" class="btn btn-primary">Register New</button></form></li>
                <li> </li>
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <table class="table datatable-basic">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Nickname</th>
                <th>email</th>
                <th>Username</th>
                <th>Avatar</th>
                <th>Language</th>
                <th>Role</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Deleted Date</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($profiles as $profile)
            <tr>
                <td>{{ $profile->user->id }}</td>
                <td>{{ $profile->name }}</td>
                <td>{{ $profile->nickname }}</td>
                <td>{{ $profile->email }}</td>
                <td>{{ $profile->user->name }}</td>
                <td>{{ $profile->avatar }}</td>
                <td>{{ $profile->language }}</td>
                <td>{{ $profile->role->name }}</td>
                <td>{{ $profile->created_at }}</td>
                <td>{{ $profile->updated_at }}</td>
                <td>{{ $profile->deleted_at }}</td>
                <!---->
                <td class="text-center">
                    <ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="/profiles/{{ $profile->user->id }}"><i class="icon-eye"></i> View</a></li>
                                <li><a href="/profiles/{{ $profile->user->id }}/edit"><i class="icon-pencil"></i> Edit</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#modal_theme_danger" onclick="choose_profile({{ $profile->user->id }})"><i class="icon-trash"></i> Delete</a></li>
                            </ul>
                        </li>
                    </ul>
                </td>
                <!--
                <td>
                    <button type="button" class="btn btn-default"><i class="icon-eye position-left"></i> View</button>
                    <button type="button" class="btn btn-default"><i class="icon-pencil position-left"></i> Edit</button>
                    <button type="button" class="btn btn-default"><i class="icon-trash position-left"></i> Delete</button>
                </td>-->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Danger modal -->
<div id="modal_theme_danger" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Delete?</h6>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete this user?</p>
            </div>

            <div class="modal-footer">
                <form method="post" id="delete_form" action="/profiles/0">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    
                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /default modal -->
@endsection

@section('script')
<script>
    window.choose_profile = function(id) {
        $("#delete_form").attr('action', '/profiles/'+id+'/');
    }
</script>
@endsection
