<header id="header" class="navbar-custom @if (Request::is('/')) navbar-transparent @endif nav-normal">
    <nav class="navbar navbar-expand-lg ">
        <div class="container-xl">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="navbar-brand nav-link" aria-current="page" href="/">HUIT Travel</a>
                    </li>

                </ul>
                <div>
                    <a href="/login" class="btn btn-login"><i class="fa-solid fa-user me-2"></i>Đăng nhập</a>
                    <a href="/login" class="btn btn-register">Đăng ký</a>
                </div>

            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Khách sạn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Vé máy bay</a>
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
    </nav>
    @if (Request::is('/'))
        <style>
            .navbar-custom .navbar-brand,
            .navbar-custom .nav-link,
            .navbar-custom .nav-item,
            .navbar-custom .navbar-toggler-icon {
                color: #fff;
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
    .navbar-custom.navbar-scrolled .navbar-toggler-icon {
        color: rgb(104, 113, 118);
        font-weight: 700;
    }

    .navbar-custom.navbar-scrolled .btn-login {
        color: rgb(104, 113, 118);;
        border: 1px solid rgb(1, 148, 243);
    }

    .nav-normal.navbar-scrolled {
        border-bottom: none;
    }

    .dropdown-menu {
        column-count: 3;
        column-gap: 1rem;
    }

    .btn-login, .btn-login:hover {
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
