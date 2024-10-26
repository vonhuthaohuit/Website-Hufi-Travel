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
                <div>
                    <a href="/login" class="btn btn-login"><i class="fa-solid fa-user me-2"></i>Đăng nhập</a>
                    <a href="/login" class="btn btn-register">Đăng ký</a>
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
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">Trang chủ</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">Tour trong nước</a>
                            <ul class="dropdown-menu">
                                <!-- Các mục dropdown -->
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">Tour nước ngoài</a>
                            <ul class="dropdown-menu">
                                <!-- Các mục dropdown -->
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">Điểm đến</a>
                            <ul class="dropdown-menu">
                                <!-- Các mục dropdown -->
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tin tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Giới thiệu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Liên hệ</a>
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
            .navbar-brand-mobile {
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

            .btn-login {
                color: #fff;
                border: 1px solid #fff;
            }

            .btn-login:hover {
                background-color: rgba(79, 79, 79, 0);
                border: 1px solid #fff;
                color: #fff;
            }
        </style>
    @else
        <style>
            .nav-normal {
                box-shadow: 0 6px 20px rgba(155, 155, 155, 0.3);
                background-color: #fff;
            }

            .btn-login {
                color: rgb(104, 113, 118);
            }
        </style>
    @endif
</header>

<style>
    @media (max-width: 767px) {
        .navbar-brand-mobile {
            display: block;
            font-weight: 700;
        }
    }

    .navbar-transparent {
        background-color: rgba(0, 0, 0, 0);
        border-bottom: 1px solid #ccc;
        transition: background-color 0.3s ease;
    }

    .navbar-scrolled {
        background-color: #fff;
        box-shadow: 0 6px 20px rgba(155, 155, 155, 0.3);
    }

    .navbar-custom.navbar-scrolled .navbar-brand,
    .navbar-custom.navbar-scrolled .nav-link,
    .navbar-custom.navbar-scrolled .nav-item,
    .navbar-custom.navbar-scrolled .navbar-toggler-icon,
    .navbar-custom.navbar-scrolled .navbar-brand-mobile {
        color: rgb(104, 113, 118);
        font-weight: 700;
    }

    .navbar-custom.navbar-scrolled .btn-login {
        color: rgb(104, 113, 118);
        ;
        border: 1px solid rgb(1, 148, 243);
    }

    .nav-normal.navbar-scrolled {
        border-bottom: none;
    }

    .dropdown-menu {
        column-count: 3;
        column-gap: 1rem;
    }

    .btn-login,
    .btn-login:hover {
        border: 1px solid rgb(1, 148, 243);
    }

    .btn-login {
        font-weight: 700;
    }

    .btn-register {
        color: #fff;
        background-color: rgb(1, 148, 243);
        font-weight: 700;
    }

    .btn-register:hover {
        color: #fff;
        background-color: rgb(1, 121, 219);
    }

    .navbar-toggler {
        border: none;
    }

    .nav-pad-bot {
        padding-top: 0;
    }
</style>

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
