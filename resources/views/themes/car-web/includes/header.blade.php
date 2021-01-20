<header class="header-menu">
<a class="maz-mobile-brand" href="/"><img src="{{asset('car-web/img/logo.svg')}}" alt=""></a>
    <div class="maz-burger-menu">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <nav class="maz-navbar position-absolute" id="maz-nav">
        <div class="container">
            <div class="maz-menu">
            <a class="maz-brand" href="/"><img src="{{asset('car-web/img/logo.svg')}}" alt=""></a>
                <ul class="maz-menu-list">
                    @foreach ($mainMenus as $menu)
                        <li class="maz-menu-item {{ Request::is(\Str::startsWith($menu->link, '/') ? substr($menu->link, 1) : $menu->link) ? 'active' : '' }}">
                            <a class="maz-menu-link" href="{{ $menu->link }}">{{ $menu->title }}
                                @if(Request::is($menu->link))
                                    <span class="sr-only">(current)</span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                    <li class="maz-menu-item">
                        @auth
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-round dropdown-toggle px-4" type="button" id="headerProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if (isset(Auth::user()->name))
                                        <span>{{ Auth::user()->name }}</span>
                                    @else
                                        <span>{{ Auth::user()->username }}</span>
                                    @endif
                                </button>
                                <div class="dropdown-menu" aria-labelledby="headerProfileDropdown">
                                    @if (Auth::user()->is_admin())
                                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Удирдлагын самбар</a>
                                    @endif
                                    @foreach ($dropdownMenus as $menu)
                                        <a class="dropdown-item" href="{{ url($menu->link) }}">{{ $menu->title }}
                                        @php
                                        if ($menu->link == '/my-notifications') {
                                            $count = \App\Entities\NotificationManager::unread(\Auth::user()->id)->count();
                                            if ($count > 0) {
                                                echo('<span class="badge badge-secondary badge-pill">' . $count . '</span>');
                                            }
                                        }
                                        @endphp
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a class="btn btn-danger btn-round my-2 my-sm-0 px-5" href="{{ url('/login') }}">Нэвтрэх</a>
                        @endauth
                    </li>
                </ul>

            </div>
            <div class="maz-menu-top">
                <ul class="maz-menu">
                    @foreach ($topbarMenus as $menu)
                        @if($menu->link == '/wishlist')
                            @if (Route::has('login'))
                                @auth
                                    <li class="maz-menu-item"><a data-toggle="modal" href="#modalAddWishlist">/ {{ $menu->title }} /</a></li>
                                @else
                                    <li class="maz-menu-item"><a href="{{ route('login') }}">/ {{ $menu->title }} /</a></li>
                                @endauth
                            @endif
                        @else
                            <li class="maz-menu-item"><a href="{{ $menu->link }}">/ {{ $menu->title }} /</a></li>
                        @endif
                    @endforeach

                    @auth
                        <li class="maz-menu-item"><a  class="btn btn-warning btn-sm btn-round px-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Гарах</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <li class="maz-menu-item"><a  class="btn btn-warning btn-sm btn-round px-3" href="{{ url('/register') }}">Бүртгүүлэх</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>

<style>
    .btn-main {
        color: #2B3651;
        background-color: #E0E5EB;
        border-color: #E0E5EB;
    }
</style>
@if (Route::has('login'))
    @auth
        @include('themes.car-web.includes.car-wishlist-add')
    @else
    @endauth
@endif
