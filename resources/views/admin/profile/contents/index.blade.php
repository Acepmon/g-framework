@extends('themes.limitless.layouts.default')

@section('load')
<!-- Theme JS files -->
<script type="text/javascript" src="{{ admin_asset('js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ admin_asset('js/pages/datatables_basic.js') }}"></script>
@endsection

@section('pageheader')
<div class="page-header-content">
    <div class="page-title">
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User Details</span></h4>
    </div>

    <div class="heading-elements">
        <div class="heading-btn-group">
            <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
            <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
            <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
        </div>
    </div>
</div>

<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="/"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ route('admin.profile.index') }}">Users</a></li>
        <li class="active">Detail</li>
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
                <li><a href="#"><i class="icon-gear"></i> All pages</a></li>
            </ul>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="has-detached-left">
    @include('admin.profile.admin.includes.sidebar')

    <!-- Detached content -->
    <div class="container-detached">
        <div class="content-detached">

            <!-- Tab content -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="contents">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Contents</h6>
                        </div>

                        <table class="table datatable-basic">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="20%">Title</th>
                                    <th width="20%">Slug</th>
                                    <th width="10%">Type</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Visibility</th>
                                    <th width="15%">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->contents->where('type', Session::get('type')) as $content)
                                <tr>
                                    <td>{{ $content->id }}</td>
                                    <td>{{ $content->title }}</td>
                                    <td>{{ $content->slug }}</td>
                                    <td>{{ $content->type }}</td>
                                    <td>{{ $content->status }}</td>
                                    <td>{{ $content->visibility }}</td>
                                    <td>{{ $content->created_at }}</td>
                                    <!---->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /tab content -->

        </div>
    </div>
</div>

@endsection

@section('script')
<script>
</script>
@endsection
