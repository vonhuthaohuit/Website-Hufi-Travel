@php
    $footerGridOne = Cache::rememberForever('footer_grid_one', function () {
        return \App\Models\FooterGridOne::first();
    });
    $footerSocials = Cache::rememberForever('footer_socials', function () {
        return \App\Models\FooterSocial::where('status', 1)->get();
    });
    $footerGridTwoLinks = Cache::rememberForever('footer_grid_two', function () {
        return \App\Models\FooterGridTwo::where('status', 1)->get();
    });
    $footerTitle = \App\Models\FooterTitle::first();
    $footerGridThreeLinks = Cache::rememberForever('footer_grid_three', function () {
        return \App\Models\FooterGridThree::where('status', 1)->get();
    });
@endphp
@if (
    @$footerGridOne == null &&
        @$footerSocials == null &&
        @$footerGridTwoLinks == null &&
        @$footerTitle == null &&
        @$footerGridThreeLinks == null)
@else
    <footer class="footer_2">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-3 col-sm-7 col-md-6 col-lg-3">
                    <div class="wsus__footer_content">
                        <a class="wsus__footer_2_logo" href="{{ url('/') }}">
                            <img src="{{ asset(@$footerGridOne->logo) }}" alt="logo"> HUFI Travel
                        </a>
                        <a class="action" href="callto:{{ @$footerGridOne->phone }}"><i class="fas fa-phone-alt ms-2">
                            </i>{{ @$footerGridOne->phone }}</a>
                        <a class="action" href="mailto:{{ @$footerGridOne->email }}"><i
                                class="far fa-envelope ms-2"></i>{{ @$footerGridOne->email }}</a>
                        <a class="action" href="#">
                            <i class="fas fa-map-marker-alt ms-2"></i>{{ @$footerGridOne->address }}
                        </a>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                    <div class="wsus__footer_content">
                        <h5>{{ @$footerTitle->footer_grid_two_title }}</h5>
                        <ul class="wsus__footer_menu">
                            @foreach (@$footerGridTwoLinks as $link)
                                <li><a href="{{ $link->url }}"><i class="fas fa-caret-right"></i>
                                        {{ $link->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                    <div class="wsus__footer_content">
                        <h5>{{ @$footerTitle->footer_grid_three_title }}</h5>
                        <ul class="wsus__footer_menu">
                            @foreach (@$footerGridThreeLinks as $link)
                                <li><a href="{{ $link->url }}"><i class="fas fa-caret-right"></i>
                                        {{ $link->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-7 col-md-8 col-lg-5">
                    <div class="wsus__footer_content wsus__footer_content_2">
                        <h3>Đăng ký nhận tin mới nhất</h3>
                        <p>Nhận tất cả thông tin mới nhất về Sự kiện, Khuyến mại và Ưu đãi của chúng tôi.</p>
                        <form action="" method="POST" id="newsletter">
                            @csrf
                            <input type="text" placeholder="Email" name="email" class="newsletter_email">
                            <button type="submit" class="common_btn subscribe_btn">Đăng ký</button>
                        </form>
                        <div class="footer_payment">
                            <h3>Social media</h3>
                            <ul class="wsus__footer_social">
                                @foreach (@$footerSocials as $link)
                                    <li><a class="behance" href="{{ $link->url }}"><i
                                                class="{{ $link->icon }}"></i></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wsus__footer_bottom">
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__copyright d-flex justify-content-center">
                            <p>{{ @$footerGridOne->copyright }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endif

<style>
    .footer_2 {
        color: #fff;
    }

    footer {
        padding-top: 70px;
    }

    .wsus__footer_content img {
        width: 160px;
        margin-bottom: 7px;
    }

    .wsus__footer_content .action,
    .wsus__footer_content p {
        display: block;
        font-size: 15px;
        margin-top: 10px;
        color: #fff;
        transition: all linear 0.3s;
        -webkit-transition: all linear 0.3s ease;
        -moz-transition: all linear 0.3s ease;
        -ms-transition: all linear 0.3s ease;
        -o-transition: all linear 0.3s ease;
    }

    .wsus__footer_content .action i {
        width: 20px;
    }

    .wsus__footer_content p {
        position: relative;
    }

    .wsus__footer_content p i {
        position: absolute;
        top: 8px;
        left: 0;
    }

    .wsus__footer_content .action:hover {
        color: #08C;
    }

    .wsus__footer_menu {
        list-style: none;
        padding: 0;
    }

    .wsus__footer_menu li a {
        color: #fff;
    }

    .wsus__footer_social {
        display: flex;
        align-items: center;
        margin-top: 15px;
        list-style: none;
        padding: 0;
    }

    .wsus__footer_social li {
        margin-right: 10px;
    }

    .wsus__footer_social li a {
        width: 35px;
        height: 35px;
        text-align: center;
        line-height: 37px;
        border-radius: 50%;
        font-size: 15px;
        background: #def0ff2e;
        color: #fff;
        transition: all linear 0.3s;
        -webkit-transition: all linear 0.3s ease;
        -moz-transition: all linear 0.3s ease;
        -ms-transition: all linear 0.3s ease;
        -o-transition: all linear 0.3s ease;
        display: block;
    }

    .facebook:hover {
        background: #1b4f9b !important;
        color: #fff;
    }

    .twitter:hover {
        background: #00adef !important;
        color: #fff;
    }

    .whatsapp:hover {
        background: #26cb46 !important;
        color: #fff;
    }

    .pinterest:hover {
        background: #c51f27 !important;
        color: #fff;
    }

    .behance:hover {
        background: #1666f7 !important;
        color: #fff;
    }

    .linkedin:hover {
        background: #0077b0 !important;
        color: #fff;
    }

    .instagram:hover {
        background: #d51332 !important;
        color: #fff;
    }

    .youtube:hover {
        background: #d51332 !important;
        color: #fff;
    }

    .wsus__footer_content h5 {
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 10px;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }

    .wsus__footer_menu li {
        color: #08C;
    }

    .wsus__footer_menu li a {
        font-weight: 400;
        text-transform: capitalize;
        font-size: 15px;
        width: 100%;
        margin-top: 11px;
        transition: all linear 0.3s;
        -webkit-transition: all linear 0.3s ease;
        -moz-transition: all linear 0.3s ease;
        -ms-transition: all linear 0.3s ease;
        -o-transition: all linear 0.3s ease;
    }

    .wsus__footer_menu li a i {
        margin-right: 5px;
    }

    .wsus__footer_menu li a:hover {
        color: #08C !important;
    }

    .wsus__footer_bottom {
        margin-top: 67px;
    }

    .wsus__copyright {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .wsus__copyright p {
        color: #fff;
        text-transform: capitalize;
        font-size: 15px;
        font-weight: 400;
    }

    .wsus__copyright p img {
        width: 150px;
        margin-left: 15px;
    }

    .wsus__footer_2_logo img {
        width: 65px;
    }

    .wsus__footer_2_logo {
        color: #fff;
        font-weight: 700;
    }

    .footer_2 form {
        position: relative;
        width: 100%;
        margin: 15px 0px 25px 0px;
    }

    .footer_2 form input {
        width: 100%;
        padding: 17px 20px;
        font-size: 16px;
        font-weight: 400;
        border-radius: 30px;
        -webkit-border-radius: 30px;
        -moz-border-radius: 30px;
        -ms-border-radius: 30px;
        -o-border-radius: 30px;
        border: none;
    }

    .footer_2 form button {
        position: absolute;
        top: 2px;
        right: 2px;
        height: 94%;
        border-radius: 30px;
    }
</style>
