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
