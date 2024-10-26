<footer>
    <div class="mid-footer">
        <div class="container-xl">
            <div class="row">
                <div class="col-lg-5">
                    <a href="/">
                        <img src="{{ asset('frontend/images/logo.png') }}" class="mb-3" alt="logo shop" width="100"
                            height="100">
                    </a>
                    <div class="single-contact row">
                        <div class="content-footer col-12 col-lg-9">
                            <a href="/" class="name-company">HUFI Travel</a> - blalalala
                        </div>
                    </div>

                </div>

                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-4">
                            <h3 class="footer-title title-menu clicked">
                                DANH MỤC
                                <i class="fa fa-angle-down d-md-none d-inline-block"></i>
                            </h3>
                            <ul class="list-menu dropdown-footer1 toggle-mn">

                                <li class="li_menu">
                                    <a class="link" href="/" title="Phim Cổ Trang">Item</a>
                                </li>

                                <li class="li_menu">
                                    <a class="link" href="/" title="Phim Cổ Trang">Item</a>
                                </li>

                                <li class="li_menu">
                                    <a class="link" href="/" title="Phim Cổ Trang">Item</a>
                                </li>

                                <li class="li_menu">
                                    <a class="link" href="/" title="Phim Cổ Trang">Item</a>
                                </li>
                                <li class="li_menu">
                                    <a class="link" href="/" title="Phim Cổ Trang">Item</a>
                                </li>

                                <li class="li_menu">
                                    <a class="link" href="/" title="Phim Cổ Trang">Item</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4">
                            <h3 class="footer-title title-menu clicked2">
                                THỂ LOẠI
                                <i class="fa fa-angle-down d-md-none d-inline-block"></i>
                            </h3>
                            <ul class="list-menu dropdown-footer2 toggle-mn">
                                <li class="li_menu">
                                    <a class="link" href="/" title="Phim Cổ Trang">Item</a>
                                </li>

                                <li class="li_menu">
                                    <a class="link" href="/" title="Phim Hành Động">Item</a>
                                </li>

                                <li class="li_menu">
                                    <a class="link" href="/" title="Phim Tình Cảm">Item</a>
                                </li>

                                <li class="li_menu">
                                    <a class="link" href="/" title="Phim Hoạt Hình">Item</a>
                                </li>


                            </ul>
                        </div>

                        <div class="col-lg-4">
                            <h3 class="footer-title title-menu clicked3">
                                THÔNG TIN
                                <i class="fa fa-angle-down d-md-none d-inline-block"></i>
                            </h3>
                            <ul class="list-menu dropdown-footer3 toggle-mn">
                                <li class="li_menu">
                                    <a class="link" href="/" title="Giới Thiệu">Giới Thiệu</a>
                                </li>

                                <li class="li_menu">
                                    <a class="link" href="/" title="Liên Hệ Với Chúng Tôi">Liên Hệ Với Chúng
                                        Tôi</a>
                                </li>

                                <li class="li_menu">
                                    <a class="link" href="/" title="Điều Khoản Sử Dụng">Điều Khoản Sử Dụng</a>
                                </li>

                                <li class="li_menu">
                                    <a class="link" href="/" title="Chính Sách Riêng Tư">Chính Sách Riêng Tư</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mb-4">
        <p class="d-flex justify-content-center">Copyright &copy; 2024 MovieLand. Powered by Vuong Tran</p>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dropdownToggle1 = document.querySelector('.clicked');
            var dropdownToggle2 = document.querySelector('.clicked2');
            var dropdownToggle3 = document.querySelector('.clicked3');
            var menuList1 = document.querySelector('.dropdown-footer1');
            var menuList2 = document.querySelector('.dropdown-footer2');
            var menuList3 = document.querySelector('.dropdown-footer3');

            dropdownToggle1.addEventListener('click', function() {
                menuList1.classList.toggle('show1');
            });

            dropdownToggle2.addEventListener('click', function() {
                menuList2.classList.toggle('show1');
            });

            dropdownToggle3.addEventListener('click', function() {
                menuList3.classList.toggle('show1');
            });
        });
    </script>
</footer>

<style>
    footer {
        box-shadow: 0 -6px 20px rgba(155, 155, 155, 0.3);

    }

    .name-company {
        color: #ec8f00;
        text-decoration: none;
    }

    .single-contact {
        display: flex;
        align-items: baseline;
        font-size: 15px;
        margin-bottom: 10px
    }

    .single-contact .fa {
        margin-right: 5px;
        width: 20px;
        flex: 0 0 20px
    }

    .fas,
    .far {
        color: black;
    }

    .title-menu {
        margin: 0px 0px 17px;
        font-weight: 500;
        font-stretch: normal;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 18px;
        font-weight: bold;
        color: #000;
    }

    .footer-title {
        font-size: 16px;
        margin-bottom: 16px;
        color: inherit;
        font-weight: bold;
    }

    .mid-footer {
        padding: 30px 0 20px 0;
        clear: both;
    }

    .list-menu {
        padding: 0;
        list-style: none;
    }

    .li_menu {
        margin-top: 7px;
    }

    a.link {
        text-decoration: none;
        cursor: pointer;
        color: var(--text-color);
    }

    a.link:hover {
        color: #ec8f00;
    }

    .social-link {
        margin: 10px;
    }

    .input-receive {
        position: relative;
        display: flex;
        width: 100%;
        align-items: stretch;
    }

    .input-receive input {
        border-radius: 100px;
        padding-left: 15px;
        border: 1px solid rgb(192, 192, 192);
        height: 45px;
        width: 100%;
    }

    .input-receive button {
        position: absolute;
        right: 0;
        z-index: 4;
        height: calc(100% - 6px);
        border-radius: 999px;
        padding: 0;
        top: 3px;
        right: 3px;
        padding: 0 15px;
        background-color: #337ccf;
    }

    .input-receive button:hover {
        background-color: #2c6cb5;
        color: #fff;
    }

    .form-receive {
        margin-bottom: 20px;
    }

    @keyframes flyDown {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes flyIn {
        from {
            opacity: 1;
            transform: translateY(0);
        }

        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }

    .hide1 {
        animation: flyIn 0.3s ease-out forwards;
        display: none;
    }

    .show1 {
        display: block;
        animation: flyDown 0.3s ease-out forwards;
    }

    @media (max-width: 768px) {
        .list-menu {
            display: none;
        }

        .list-menu.show1 {
            display: block;
        }
    }
</style>
