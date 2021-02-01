<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
        <div class="navbar-brand">
            <a class="d-inline-block" href="{{ route('admin.dashboard') }}"><img src="{{ config('app.logo') }}" alt="{{ config('app.name') }}"></a>
        </div>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block"><i class="icon-paragraph-justify3"></i></a></li>

            @include('admin.configs.includes.maintenance-menu-item')

            <li class="nav-item">
                <a href="/" class="navbar-nav-link">
                    <span class="icon-home2 mr-2"></span>
                    {{ env('APP_NAME', 'My Site') }}
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-xl-auto">
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown" id="notificationsDropdownToggle">
                    <i class="icon-bell2"></i>
                    <span class="d-md-none ml-2">Notifications</span>
                    <span id="notificationsCount" class="badge badge-pill bg-warning-400 ml-auto ml-md-0"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                    <div class="dropdown-content-header">
                        <span class="font-weight-semibold">Notifications</span>
                        {{-- <a href="#" class="text-default"><i class="icon-compose"></i></a> --}}
                        <button onclick="markAsRead()" id="notificationsMarkReadBtn" class="text-white btn btn-primary btn-sm">Mark as Read</button>
                    </div>

                    <div class="dropdown-content-body dropdown-scrollable">
                        <ul class="media-list" id="notif-list">
                            <div class="no-notif text-center">You do not have any notifications</div>
                            <!-- @foreach(Auth::user()->unreadNotifications as $notification)
                                <li class="media">
                                    @if (!empty($notification->data['thumbnail']))
                                    <div class="mr-2">
                                        <img src="{{ $notification->data['thumbnail'] }}" class="rounded-circle" alt="" style="max-width: 35px; height: auto;">
                                    </div>
                                    @endif

                                    <div class="media-body">
                                        <a href="#" class="media-heading">
                                            <span class="text-semibold">{{ $notification->data['title'] }}</span>
                                            <span class="text-muted float-right">{{ $notification->created_at->diffForHumans() }}</span>
                                        </a>

                                        <p class="text-muted">{{ $notification->data['body'] }}</p>
                                    </div>
                                </li>
                            @endforeach

                            @if(count(Auth::user()->unreadNotifications) == 0)
                                <div class="text-center">You do not have any notifications</div>
                            @endif -->
                        </ul>
                    </div>
<!-- 
                    <div class="dropdown-content-footer justify-content-center p-2">
                        <a href="{{ route('admin.profile.notifications.index') }}" data-popup="tooltip" title="All Notifications"><i class="icon-menu display-block"></i></a>
                    </div> -->
                </div>
            </li>

            <li class="nav-item dropdown dropdown-user">
                <a class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img class="rounded-circle mr-2" src="{{ Auth::user()->avatar_url() }}" height="34" alt="">
                    <span>{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="/" class="dropdown-item"><i class="icon-home2"></i> {{ env('APP_NAME', 'My Site') }}</a>
                    <a href="{{ route('admin.profile.index') }}" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                    <div class="dropdown-divider"></div>
                    <div>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-switch2"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->

<script>

function markAsRead() {
    $("#notif-list").html(`<div class="text-center">You do not have any notifications</div>`);

    $("#notificationsCount").html("");
    var titles = document.title.split(")");
    if (titles[0].startsWith("(")) {
        document.title = titles[1];
    }
    /*$.ajax({
        url: '/admin/profile/notifications/read'
    }).done(function() {
        $("#notificationsCount").remove();
        $("#notificationsMarkReadBtn").attr('disabled', true);
        $("#notificationsList").html('<div class="text-center">You do not have any notifications</div>');
    });*/
}
</script>
