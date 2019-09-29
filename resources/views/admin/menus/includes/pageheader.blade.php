<div class="page-header-content header-elements-inline">
    <div class="page-title d-flex">
        <h4><i class="icon-arrow-left52 ml-2"></i> <span class="font-weight-semibold">Menus</span> - @yield('title')</h4>
    </div>
</div>

<div class="breadcrumb-line">
    @if (isset($breadcrumb))
        {{ Breadcrumbs::render($breadcrumb) }}
    @endif
</div>
