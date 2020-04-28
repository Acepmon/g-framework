<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-brand">
                    CAR DEALER
                </div>
            </div>
            <div class="col-md-6 text-right">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item mr-3">
                        <a href="#">
                            <i class="fab fa-facebook fa-2x fa-fw"></i>
                        </a>
                    </li>
                    <li class="list-inline-item mr-3">
                        <a href="#">
                            <i class="fab fa-twitter fa-2x fa-fw"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fab fa-instagram fa-2x fa-fw"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-12 mt-4">
                <div class="row">
                    <div class="col-lg-6 h-100 text-center text-white text-lg-left my-auto">
                        <ul class="list-inline mb-2">
                            @foreach ($mainMenus as $menu)
                            <li class="list-inline-item">
                                <a href="{{ $menu->link }}">{{ $menu->title }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-6 h-100 text-right text-muted my-auto">
                        <ul class="list-inline mb-2">
                            @foreach ($footerMenus as $menu)
                            <li class="list-inline-item">
                                <a href="{{ $menu->link }}">{{ $menu->title }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center mt-5">
                <p class="text-muted small mb-4 mb-lg-0">&copy; Damoa Motors {{ date_format(\Carbon\Carbon::now(), 'Y') }}. All Rights Reserved.</p>
            </div>
        </div>

    </div>
    <svg class="footer-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 370">
        <polygon points="1920 9.56 0 82.45 0 370 1920 370 1920 9.56" />
    </svg>
</footer>
<!-- /footer -->
