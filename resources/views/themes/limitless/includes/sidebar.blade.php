<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
    <div class="sidebar-content">

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                @foreach(Auth::user()->menus->where('parent_id', 1)->unique()->groupBy('module')->sortBy('order') as $key => $module)
                    <li class="nav-item-header">
                        <div class="text-uppercase font-size-xs line-height-xs">{{ $key }}</div>
                        <i class="icon-menu" title="{{ $key }}"></i>
                    </li>

                    @each('themes.limitless.includes.sidemenus', Auth::user()->menus->where('module', $key)->where('parent_id', 1)->unique()->sortBy('order'), 'menu')
                @endforeach
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->
