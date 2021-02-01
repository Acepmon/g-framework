
@if($menu)
<li class="nav-item {{ Auth::user()->menus->where('parent_id', $menu->id)->count() > 0 ? 'nav-item-submenu' : '' }}">
    <a class="nav-link" href="{{ $menu->link }}">
        @if ($menu->icon)
        <i class="{{ $menu->icon}}"></i>
        @endif
        <span>{{ $menu->title }}</span>

        @php
            $count = 0;
            $best_premium = Modules\Car\Http\Controllers\Admin\CarBestPremiumController::getCount();
            $premium = Modules\Car\Http\Controllers\Admin\CarPremiumController::getCount();
            switch ($menu->title)  {
                case 'Cars':
                    $count = $best_premium + $premium;
                    break;
                case 'Best':
                    $count = $best_premium;
                    break;
                case 'Special':
                    $count = $premium;
                    break;
                case 'Transactions':
                    $count = Modules\Payment\Http\Controllers\Admin\TransactionController::getCount();
                    break;
                case 'Verification Requests':
                    $count = Modules\Car\Http\Controllers\Admin\CarVerificationController::getCount();
                    break;
                case 'Loan Check':
                    $count = Modules\Car\Http\Controllers\Admin\CarLoanCheckController::getCount();
                    break;
            }
            if ($count > 0) {
                echo('<span id="' . $menu->title . '-count" class="badge bg-blue-700 align-self-center ml-auto">' . $count . '</span>');
            }
        @endphp
    </a>

    @if(Auth::user()->menus->where('parent_id', $menu->id)->count() > 0)
    <ul class="nav nav-group-sub" data-menu-title="{{ $menu->title }}">
        @each('themes.limitless.includes.sidemenus', Auth::user()->menus->where('parent_id', $menu->id)->unique()->sortBy('order'), 'menu')
    </ul>
    @endif

</li>
@endif
