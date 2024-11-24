<header id="header"
    class="fixed-top navbar-custom @if (Request::is('/')) navbar-transparent @endif nav-normal">
    <nav class="navbar navbar-expand-lg">
        <div class="container-xl">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="navbar-brand nav-link" aria-current="page" href="/"><img
                                src="{{ asset('frontend/images/logo.png') }}" alt="HUFI Travel" width="40">HUFI
                            Travel</a>
                    </li>

                </ul>
                <a class="me-3 transaction centro" style="font-size: 15px;" href="{{ route('transaction') }}">Giao dịch của tôi</a>
                <div class="d-flex align-items-center">
                    @if (session('user'))
                        <button href="#" class="show-form-search me-3"><i class="fas fa-search"></i></button>
                        <div class="dropdown">
                            <a href="#" class="btn btn-login dropdown-toggle" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user me-2"></i>{{ session('user')->tentaikhoan }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Hồ sơ</a></li>
                                <li><a class="dropdown-item" href="#">Setting</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a></li>
                            </ul>
                        </div>
                    @else
                        <button href="#" class="show-form-search me-3"><i class="fas fa-search"></i></button>
                        <a href="{{ route('login_view') }}" class="btn btn-login"><i
                                class="fa-solid fa-user me-2"></i>Đăng nhập</a>
                    @endif
                </div>

            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg nav-pad-bot">
        <div class="container-xl">
            <a class="navbar-brand-mobile d-lg-none" href="/">
                <img src="{{ asset('frontend/images/logo.png') }}" alt="HUFI Travel" width="50"> HUFI Travel
            </a>
            <label class="navbar-toggler ms-auto d-lg-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </label>
            <div class="offcanvas offcanvas-start" id="offcanvasNavbar" tabindex="-1"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><a href="/"><img
                                src="{{ asset('frontend/images/logo.png') }}" alt="HUFI Travel" width="100"></a></h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav flex-grow-1 pe-3">
                        <li class="nav-item centro">
                            <a class="nav-link" aria-current="page" href="/">Trang chủ</a>
                        </li>
                        <li class="nav-item dropdown">
                            <div class="centro" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <a class="nav-link dropdown-toggle" href="#">Danh sách tour</a>
                            </div>

                            <ul class="dropdown-menu dropdown-column">
                                @foreach ($listTours as $item)
                                    <li><a class="dropdown-item"
                                            href="{{ route('tour.search', ['category' => $item->tenloai]) }}">{{ $item->tenloai }}</a>
                                    </li>
                                @endforeach

                                <li><a class="dropdown-item" href="{{ route('tour.all-tour') }}">Tất cả tour</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <div class="centro" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <a class="nav-link dropdown-toggle" href="#">Điểm du lịch</a>
                            </div>

                            <ul class="dropdown-menu dropdown-column">
                                @foreach ($destinationHeader as $item)
                                    <li><a class="dropdown-item"
                                            href="{{ route('tour.byDestination', $item->tendiemdulich) }}">{{ $item->tendiemdulich }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item centro">
                            <a class="nav-link" href="{{ route('blog.blog-all') }}">Blog</a>
                        </li>
                        <li class="nav-item centro">
                            <a class="nav-link" href="{{ route('about') }}">Giới thiệu</a>
                        </li>
                        <li class="nav-item centro">
                            <a class="nav-link" href="{{ route('contact') }}">Liên hệ</a>
                        </li>
                        <li class="nav-item d-lg-none  centro">
                            <a class="nav-link" href="{{ route('login_view') }}">Đăng nhập</a>
                        </li>
                        <li class="nav-item d-lg-none">
                            <a class="nav-link"><button class="show-form-search"><i
                                        class="fas fa-search"></i></button></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    @if (Request::is('/'))
        <style>
            .navbar-custom .navbar-brand,
            .navbar-custom .nav-link,
            .navbar-custom .nav-item,
            .navbar-custom .navbar-toggler-icon,
            .navbar-brand-mobile,
            .show-form-search,
            .transaction {
                color: #fff;
            }

            @media (max-width: 767px) {

                .navbar-custom,
                .navbar-custom .nav-link,
                .navbar-custom .nav-item,
                .navbar-custom .navbar-toggler-icon {
                    color: rgb(104, 113, 118);
                }
            }

            .btn-login,
            .show-form-search {
                color: #fff;
                border: 1px solid #fff;
            }

            .btn-login:hover {
                background-color: rgba(79, 79, 79, 0);
                border: 1px solid #fff;
                color: #fff;
            }

            .centro:hover:after {
                width: 100%;
                background: #fff;
            }
        </style>
    @else
        <style>
            .nav-normal {
                box-shadow: 0 6px 20px rgba(155, 155, 155, 0.3);
                background-color: #fff;
            }

            .btn-login {
                color: rgb(1, 148, 243);
            }
        </style>
    @endif

</header>

@include('frontend.layouts.component.search-box')

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('header');
            if (!header) return;

            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    header.classList.add('navbar-scrolled');
                } else {
                    header.classList.remove('navbar-scrolled');
                }
            });
        });
    </script>
@endpush
