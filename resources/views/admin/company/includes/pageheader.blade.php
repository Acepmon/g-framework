<div class="page-header-content header-elements-inline">
    <div class="page-title d-flex">
        <h4><i class="icon-arrow-left52 ml-2"></i> <span class="font-weight-semibold">Companies</span> - @yield('title')</h4>
    </div>

    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href="{{ route('admin.company.create') }}" class="btn btn-link btn-float text-default"><i class="icon-plus3 text-primary"></i><span>New Company</span></a>
        </div>
    </div>
</div>

<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
    <div class="d-flex">
        <div class="breadcrumb">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a></li>
            <a href="{{ route('admin.company.index') }}" class="breadcrumb-item">Companies</a>
            <span class="breadcrumb-item active">Detail</span>
        </div>
    </div>
</div>
