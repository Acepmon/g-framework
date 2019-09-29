<div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Configurations</span> - @yield('title')</h4>
        <a href="#" class="header-elements-toggle text-default d-md-none">
            <i class="icon-more"></i>
        </a>
    </div>
</div>

<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
    <div class="d-flex">
        @if (isset($breadcrumb))
            {{ Breadcrumbs::render($breadcrumb) }}
        @endif
    </div>
</div>