<div class="page-header-content header-elements-inline">
    <div class="page-title d-flex">
        <h4><i class="icon-arrow-left52 ml-2"></i> <span class="font-weight-semibold">Localizations</span> - @yield('title')</h4>
    </div>
</div>

<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
    <div class="d-flex">
        @if (isset($breadcrumb))
            {{ Breadcrumbs::render($breadcrumb) }}
        @endif
    </div>
</div>
