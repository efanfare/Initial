<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('panel.site_title') }} - {{ $title }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/fav-icon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    @yield('styles')
</head>

<body class="{{ $bodyClass }}">
    @yield('content')
    <!-- FOOTER SECTION BEGIN -->

    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="footer-flex">
                        <div class="footer-logo">
                            <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="image"
                                    class="img-fluid"></a>
                        </div>
                        <div class="footer-nav-links">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                {{-- <li><a href="javascript:void(0)">Support</a></li> --}}
                                <li><a href="{{ route('terms') }}">Terms of use</a></li>
                                <li><a href="{{ route('privacy') }}">Privacy policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="copyright-text">
                        <p>Copyright © 2023 efanfare. All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- FOOTER SECTION END -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script>
        /*MENUBAR SCRIPT BEGIN*/
        const navbarMenu = document.getElementById("menu");
        const burgerMenu = document.getElementById("burger");
        const headerMenu = document.getElementById("header");
        const overlayMenu = document.querySelector(".overlay");
        if (burgerMenu && navbarMenu) {
            burgerMenu.addEventListener("click", () => {
                burgerMenu.classList.toggle("is-active");
                navbarMenu.classList.toggle("is-active");
            });
        }
        window.addEventListener("resize", () => {
            if (window.innerWidth >= 992) {
                if (navbarMenu.classList.contains("is-active")) {
                    navbarMenu.classList.remove("is-active");
                    overlayMenu.classList.remove("is-active");
                }
            }
        });
        /*MENUBAR SCRIPT END*/
        /*PLANS TAB SCRIPT BEGIN*/
        let allTabs = document.querySelectorAll(".tabs");
        allTabs.forEach((tabs) => {
            tabs.addEventListener("click", function(e) {
                currTabParent = this.className.split(" ").join(".");
                currTabParentData = e.target.dataset.attr;
                let currTabWidth = e.target.offsetWidth;
                let currTabLeftVal = e.target.offsetLeft;
                document.querySelector("." + currTabParent + " .active_box").style.width =
                    currTabWidth + "px";
                document.querySelector("." + currTabParent + " .active_box").style.left =
                    currTabLeftVal + "px";
                var tabs = document.querySelectorAll("." + currTabParent + " .tab");
                tabs.forEach((tab) => {
                    tab.classList.remove("active");
                });
                e.target.classList.add("active");
                let currTabContent = this.className.split(" ").slice(1).join(".");
                let dSet = e.target.dataset.attr;
                var tabsContentHide = document.querySelectorAll(
                    ".tabs_content" + "." + currTabContent + "> div"
                );
                tabsContentHide.forEach((tabContentHide) => {
                    tabContentHide.classList.remove("active");
                });
                var tabsContent = document.querySelectorAll(
                    ".tabs_content" + "." + currTabContent + " [attr=" + dSet + "]"
                );
                tabsContent.forEach((tabContent) => {
                    tabContent.classList.add("active");
                });
            });
        });
        document.querySelectorAll(".tabs .tab:nth-child(2)").forEach((element) => {
            element.click();
        });
        /*PLANS TAB SCRIPT END*/
    </script>
    @yield('scripts')
</body>

</html>
