<div class="page-header-content header-elements-inline">
    <div class="page-title d-flex">
        <h4><i class="icon-arrow-left52 ml-2"></i> <span class="font-weight-semibold">Car Management</span> - @yield('title')</h4>
    </div>

    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href="{{ route('admin.modules.car.create') }}" class="btn btn-link btn-float text-default"><i class="icon-plus3 text-primary"></i><span>Add Car</span></a>
        </div>
    </div>
</div>

<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
    <div class="d-flex">
        <div class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}"><i class="icon-home2 ml-2"></i> Home</a>
            <a class="breadcrumb-item" href="{{ route('admin.modules.car.index') }}">Cars</a>
            <span class="breadcrumb-item active">Detail</span>
        </div>
    </div>

    <div class="header-elements d-none">
        <div class="breadcrumb justify-content-center">
            <a href="{{ route('admin.modules.car.verifications.index') }}" class="breadcrumb-elements-item">
                <span class="icon-clipboard2 mr-2"></span>
                Verification Request
            </a>
            <a href="{{ route('admin.modules.car.options.index') }}" class="breadcrumb-elements-item">
                <span class="icon-cog mr-2"></span>
                Car Options
            </a>

            <div class="breadcrumb-elements-item dropdown p-0">
                <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-car mr-2"></i>
                    Cars
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('admin.modules.car.free.index') }}" class="dropdown-item">Free Cars</a>
                    <a href="{{ route('admin.modules.car.premium.index') }}" class="dropdown-item">Special Cars</a>
                    <a href="{{ route('admin.modules.car.best_premium.index') }}" class="dropdown-item">Best Cars</a>
                </div>
            </div>
        </div>
    </div>
</div>
