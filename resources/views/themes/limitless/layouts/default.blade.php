<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title', 'MAZ admin')</title>

	<!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('limitless/bootstrap4/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('limitless/bootstrap4/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('limitless/bootstrap4/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('limitless/bootstrap4/css/layout.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('limitless/bootstrap4/css/components.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('limitless/bootstrap4/css/colors.min.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/main/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/main/bootstrap.bundle.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/plugins/loaders/blockui.min.js') }}"></script>
	<!-- /core JS files -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/3.1.0/socket.io.min.js" integrity="sha512-ZqQWGugamKhlSUqM1d/HMtwNG+hITmd/ptoof91lt5ojFZ+2bKlkvlzkmnDIrnikDY+UDVZVupLf6MNbuhtFSw==" crossorigin="anonymous"></script>
	
    @yield('load-before')

    <!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('limitless/bootstrap4/js/app.js') }}"></script>
    <!-- /theme JS files -->

	@yield('load')

</head>

<body>

    @include('themes.limitless.includes.navbar')

    <!-- Page content -->
    <div class="page-content" id="app">

        @include('themes.limitless.includes.sidebar')

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header page-header-light">
                @yield('pageheader')
            </div>
            <!-- /page header -->

            <!-- Content area -->
            <div class="content">

                @yield('content')

            </div>
            <!-- /content area -->
            
            @include('themes.limitless.includes.footer')
        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

    @yield('script')

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        // Pusher.logToConsole = true;
        var pusher = new Pusher('84a3880e79c96f669a62', {
        cluster: 'ap3'
        });

        var audio = new Audio('{{ asset('limitless/bootstrap4/juntos.mp3') }}');
        var channel = pusher.subscribe('notification');
        channel.bind('App\\Events\\MessagePushed', function(data) {
            $(".no-notif").hide();
            $("#notif-list").append(`<li class="media">
                                        <div class="media-body">
                                            <a href="#" class="media-heading">
                                                <span class="text-semibold">New ${data.message}</span>
                                                <span class="text-muted float-right">${new Date().toLocaleTimeString()}</span>
                                            </a>
                                        </div>
                                    </li>`);
        
            try {
                var count = $("#" + data.message + "-count").html();
                count = parseInt(count);
                if (isNaN(count)) {
                    count = 0;
                }
                count = count + 1;
                $("#" + data.message + "-count").html(count);
            } catch (e) {console.log(e)}
            audio.play();
            var count = 1;
            var titles = document.title.split(")");
            try {
                if (titles[0].startsWith("(")) {
                    count = titles[0];
                    count = count.substr(1);
                    count = parseInt(count) + 1;
                    titles = titles[1];
                } else {
                    titles = titles[0];
                }
            } catch (e) {}

            $("#notificationsCount").html(count);
            document.title = '('+count+') ' + titles;
        });
    </script>

</body>
</html>
