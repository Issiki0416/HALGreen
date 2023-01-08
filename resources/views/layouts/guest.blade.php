<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animsition.min.css') }}">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body>
    <header class="header" id="header">
        <div class="logo">
            <a href="#"><img class="logo-img" src="images/logo.png" alt="ロゴ画像" /></a>
        </div>
        <div class="headerNav">
            <ul class="headerList">
                <li class="headerItem"><a href="{{ route('user.login') }}">ログイン</a></li>
                <li class="headerItem"><a href="{{ route('user.register') }}">会員登録</a></li>
                <li class="headerItem"><a href="#about-us">ABOUT US</a></li>
                <li class="headerItem"><a href="#gallery">Gallery</a></li>
                <li class="headerItem"><a href="#map">Map</a></li>
            </ul>
        </div>
    </header>
    <div class="flex">
        <div class="font-sans w-2/4 text-gray-900 antialiased">
            {{ $slot }}
        </div>
        <div class="mainvisual bg-slider"></div>
    </div>

    <main class="main-home">
        <div id="about-us">
            <h2 class="main-home__heading-title">ABOUT US</h2>
            <h3 class="main-home__heading-lead">HAL Greenは観葉植物専門店です。</h3>
            <p class="main-home__txt">
                観葉植物は、枝葉が伸びて姿かたちが変わる成長するインテリア。
                わたしたちは植物と家族のようにふれ合い、長く育ててほしいと考えています。
                ちいさなよろこびや楽しみがある毎日。あなたとともに成長する植物たちと暮らしてみませんか。落ち着いた空間で、ゆっくりお過ごしください。
            </p>
        </div>
    </main>

    <div class="contents_wrap flex_wrap">
        <div class="main-img-wrap">
            <h2 class="content_title" id="gallery">Gallery</h2>
            <img src="images/gallery_main.jpg" class="main-gallery-img" />
        </div>
        <div class="list_wrap">
            <ul class="main-second__gallery">
                <li class="main-second__gallery-item fadein">
                    <a data-fancybox="gallery" href="images/001.jpg">
                        <img src="images/001.jpg" class="main-second__gallery-img" /></a>
                    <p class="main-second__gallery-caption">オリーブの木</p>
                </li>
                <li class="main-second__gallery-item fadein">
                    <a data-fancybox="gallery" href="images/002.jpg">
                        <img src="images/002.jpg" class="main-second__gallery-img" /></a>
                    <p class="main-second__gallery-caption">アガベ ベネズエラ</p>
                </li>
                <li class="main-second__gallery-item fadein">
                    <a data-fancybox="gallery" href="images/003.jpg">
                        <img src="images/003.jpg" class="main-second__gallery-img" /></a>
                    <p class="main-second__gallery-caption">ソテツ</p>
                </li>
                <li class="main-second__gallery-item fadein">
                    <a data-fancybox="gallery" href="images/004.jpg">
                        <img src="images/004.jpg" class="main-second__gallery-img" /></a>
                    <p class="main-second__gallery-caption">フィカス ベンジャミン</p>
                </li>
                <li class="main-second__gallery-item fadein">
                    <a data-fancybox="gallery" href="images/005.jpg">
                        <img src="images/005.jpg" class="main-second__gallery-img" /></a>
                    <p class="main-second__gallery-caption">サンスベリア</p>
                </li>
                <li class="main-second__gallery-item fadein">
                    <a data-fancybox="gallery" href="images/006.jpg">
                        <img src="images/006.jpg" class="main-second__gallery-img" /></a>
                    <p class="main-second__gallery-caption">パキラ</p>
                </li>
                <li class="main-second__gallery-item fadein">
                    <a data-fancybox="gallery" href="images/004.jpg">
                        <img src="images/004.jpg" class="main-second__gallery-img" /></a>
                    <p class="main-second__gallery-caption">フィカス ベンジャミン</p>
                </li>
                <li class="main-second__gallery-item fadein">
                    <a data-fancybox="gallery" href="images/005.jpg">
                        <img src="images/005.jpg" class="main-second__gallery-img" /></a>
                    <p class="main-second__gallery-caption">サンスベリア</p>
                </li>
                <li class="main-second__gallery-item fadein">
                    <a data-fancybox="gallery" href="images/006.jpg">
                        <img src="images/006.jpg" class="main-second__gallery-img" /></a>
                    <p class="main-second__gallery-caption">パキラ</p>
                </li>
            </ul>
        </div>
    </div>


    <main class="main-second">
        <h2 class="main-second__h2" id="map">MAP</h2>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.408204658542!2d139.6948952152591!3d35.69157118019182!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188cd6982081c9%3A0xafd700f0055db7ef!2z44CSMTYwLTAwMjMg5p2x5Lqs6YO95paw5a6_5Yy66KW_5paw5a6_77yR5LiB55uu77yX4oiS77yT!5e0!3m2!1sja!2sjp!4v1588841381358!5m2!1sja!2sjp"
            width="830" height="500" frameborder="0" style="border: 0" allowfullscreen="" aria-hidden="false"
            tabindex="0"></iframe>
    </main>

    <footer class="footer">
        Copyright &copy; 2022 HAL Green All Rights Reserved.
    </footer>
    <script src="{{ asset('js/smooth-scroll.js') }}"></script>
    <script src="{{ asset('js/header-scroll.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script src="{{ asset('js/jquery.bgswitcher.js') }}"></script>
    <script>
        jQuery(function($) {
            $(".bg-slider").bgSwitcher({
                images: ["{{ asset('images/main2.jpg') }}",
                "{{ asset('images/main1.jpg') }}"], // 切替背景画像を指定
                interval: 6000, // 背景画像を切り替える間隔を指定 3000=3秒
                loop: true, // 切り替えを繰り返すか指定 true=繰り返す　false=繰り返さない
                shuffle: true, // 背景画像の順番をシャッフルするか指定 true=する　false=しない
                effect: "fade", // エフェクトの種類をfade,blind,clip,slide,drop,hideから指定
                duration: 3000, // エフェクトの時間を指定します。
                easing: "swing", // エフェクトのイージングをlinear,swingから指定
            });
        });

        $(function() {
            $(window).scroll(function() {
                $(".fadein").each(function() {
                    var targetElement = $(this).offset().top;
                    var scroll = $(window).scrollTop();
                    var windowHeight = $(window).height();
                    if (scroll > targetElement - windowHeight + 200) {
                        $(this).css("opacity", "1");
                        $(this).css("transform", "translateY(0)");
                    }
                });
            });
        });

        // ページ内リンクのみ取得
        var scroll = new SmoothScroll('a[href*="#"]', {
            speed: 300, //スクロールする速さ
            header: "#header", //固定ヘッダーがある場合
        });
    </script>
</body>

</html>
