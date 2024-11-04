@extends('frontend.layouts.app')

@section('renderBody')
    <section class="page-header">
        <div class="page-header__top">
            <div class="page-header-bg">
            </div>
            <div class="page-header-bg-overly"></div>
            <div class="container">
                <div class="page-header__top-inner">
                    <h2>Liên hệ</h2>
                </div>
            </div>
        </div>
        <div class="page-header__bottom">
            <div class="container pt-4">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <div class="contact-section">
        <div class="container-xl">
            <div class="contact-group">
                <div class="contact-image">
                    <img src="https://mauweb.monamedia.net/lets-travel/wp-content/uploads/2018/02/contact-people.png"
                        alt="Contact Image">
                </div>

                <div class="contact-form text-center">
                    <h2>LIÊN HỆ VỚI CHÚNG TÔI</h2>
                    <p>Chỉ cần đóng gói và đi! Hãy để lại kế hoạch du lịch của bạn cho các chuyên gia du lịch!</p>
                    <form action="/lets-travel/lien-he/#wpcf7-f5-p20-o1" method="post" novalidate="novalidate">
                        <input type="text" name="text-name" class="form-input" placeholder="Họ và tên" required>
                        <input type="email" name="email-contact" class="form-input" placeholder="Email" required>
                        <textarea name="textarea-mess" class="form-input" placeholder="Nội dung" rows="4" required></textarea>
                        <button type="submit" class="submit-button">Gửi tin nhắn</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="information">
        <div class="container-xl">
            <div class="row">
                <div class="col-xl-4 col-lg-4">
                    <!--Information Single-->
                    <div class="information__single">
                        <div class="information__icon" style="min-width: 60px;">
                            <span class="icon-place"></span>
                        </div>
                        <div class="information__text">
                            <p>140 Lê Trọng Tấn, Tây Thạnh, Tân Phú, TP. HCM</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <!--Information Single-->
                    <div class="information__single">
                        <div class="information__icon">
                            <span class="icon-phone-call"></span>
                        </div>
                        <div class="information__text">
                            <h4>
                                <a href="tel:+92-666-888-0000" class="information__number-1">0123 456 789</a>
                                <br>
                                <a href="tel:666-888-0000" class="information__number-2">0987 654 321</a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <!--Information Single-->
                    <div class="information__single">
                        <div class="information__icon">
                            <span class="icon-at"></span>
                        </div>
                        <div class="information__text">
                            <h4>
                                <a href="mailto:needhelp@tevily.com" class="information__mail-1">contact@hufitravel.com</a>
                                <br>
                                <a href="mailto:info@tevily.com" class="information__mail-2">info@hufitravel.com</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="map-container">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.0625276151345!2d106.62637497461337!3d10.806523089344044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752be2853ce7cd%3A0x4111b3b3c2aca14a!2zMTQwIMSQLiBMw6ogVHLhu41uZyBU4bqlbiwgVMOieSBUaOG6oW5oLCBUw6JuIFBow7osIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1730700045593!5m2!1svi!2s"
            width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
@endsection
