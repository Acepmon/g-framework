<div class="page-header-content header-elements-inline">
    <div class="page-title d-flex">
        <h4><i class="icon-arrow-left52 ml-2"></i> <span class="font-weight-semibold">Banners</span> - @yield('title')</h4>
    </div>

    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href="{{ route('admin.banners.create') }}" class="btn btn-link btn-float text-default"><i class="icon-plus3 text-primary"></i><span>New Banner</span></a>
        </div>
    </div>
</div>

<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
    <div class="d-flex">
        @if (isset($breadcrumb))
            {{ Breadcrumbs::render($breadcrumb) }}
        @endif
    </div>

    <div class="breadcrumb-elements-item dropdown p-0">
        <a href="{{ route('admin.banners.locations.index') }}" class="breadcrumb-elements-item">
            Banner Locations
        </a>
    </div>
</div>
