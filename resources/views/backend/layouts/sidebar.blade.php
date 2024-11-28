<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}"><img src="{{ asset('frontend/images/logo.png') }}" alt="HUFI Travel"
                    width="50px"> HUFI
                Travel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href=""><img src="{{ asset('frontend/images/logo.png') }}" alt="HUFI Travel" width="30px"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Trang chủ</li>
            <li class="dropdown {{ setActive(['dashboard']) }}">
                <a href="{{ route('dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Quản lý chức năng</li>
            <li class="dropdown {{ setActive(['tour.*', 'loaitour.*', 'khuyenmai.*', 'diemdulich.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i>
                    <span>Quản lý tour</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['tour.*']) }}">
                        <a class="nav-link" href="{{ route('tour.index') }}">Tours</a>
                    </li>
                    <li class="{{ setActive(['loaitour.*']) }}">
                        <a class="nav-link" href="{{ route('loaitour.index') }}">Loại tour</a>
                    </li>
                    <li class="{{ setActive(['khuyenmai.*']) }}">
                        <a class="nav-link" href="{{ route('khuyenmai.index') }}">Khuyến mãi</a>
                    </li>
                    <li class="{{ setActive(['diemdulich.*']) }}">
                        <a class="nav-link" href="{{ route('diemdulich.index') }}">Điểm du lịch</a>
                    </li>


                </ul>
            </li>

            <li class="dropdown {{ setActive(['khachsan.*', 'phuongtien.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cart-plus"></i>
                    <span>Quản lý dịch vụ</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['khachsan.*']) }}"><a class="nav-link"
                            href="{{ route('khachsan.index') }}">Khách sạn</a>
                    </li>
                    <li class="{{ setActive(['phuongtien.*']) }}"><a class="nav-link"
                            href="{{ route('phuongtien.index') }}">
                            Phương tiện</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive(['chucvu.*', 'nhanvien.*', 'phongban.*', 'quyen.*', 'nhomquyen.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Quản lý quyền hạn</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['chucvu.*']) }}"><a class="nav-link"
                            href="{{ route('chucvu.index') }}">Quản lý chức vụ</a></li>
            </li>
            <li class="{{ setActive(['nhanvien.*']) }}"><a class="nav-link" href="{{ route('nhanvien.index') }}">Quản
                    lý nhân viên</a></li>
            <li class="{{ setActive(['phongban.*']) }}"><a class="nav-link" href="{{ route('phongban.index') }}">Quản
                    lý phòng ban</a></li>
            <li class="{{ setActive(['quyen.*']) }}"><a class="nav-link" href="{{ route('quyen.index') }}">Quản lý
                    quyền</a></li>
            <li class="{{ setActive(['nhomquyen.*']) }}"><a class="nav-link"
                    href="{{ route('nhomquyen.index') }}">Quản lý nhóm quyền</a></li>
        </ul>
        </li>

        <li class="dropdown {{ setActive(['hoadon.*', 'phieudattour.*', 'phieuhuytour.*']) }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-invoice"></i>
                <span>Quản lý hoá đơn</span></a>
            <ul class="dropdown-menu">

                <li class="{{ setActive(['hoadon*']) }}"><a class="nav-link" href="{{ route('hoadon.index') }}">Hoá
                        đơn</a></li>
                <li class="{{ setActive(['phieuhuytour.*']) }}"><a class="nav-link"
                        href="{{ route('phieuhuytour.index') }}">Phiếu huỷ tour</a></li>
            </ul>
        </li>

        <li class="dropdown {{ setActive(['loaiblog.*', 'blog.*']) }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fab fa-blogger-b"></i>
                <span>Quản lý Blog</span></a>
            <ul class="dropdown-menu">

                <li class="{{ setActive(['loaiblog.*']) }}"><a class="nav-link"
                        href="{{ route('loaiblog.index') }}">Loại Blog</a></li>
                <li class="{{ setActive(['blog.*']) }}"><a class="nav-link" href="{{ route('blog.index') }}">Blog</a>
                </li>
            </ul>
        </li>

        <li class="{{ setActive(['danhsachtour']) }}">
            <a class="nav-link {{ setActive(['danhsachtour']) }}" href="{{ route('danhsachtour') }}"><i
                    class="fas fa-briefcase"></i>
                <span>Phân công công việc</span>
            </a>
        </li>

        <li class="{{ setActive(['danhgia.*']) }}">
            <a href="{{ route('danhgia.index') }}" class="nav-link {{ setActive(['danhgia.index']) }}">
                <i class="fas fa-comments"></i>
                <span>Quản lý đánh giá</span>
            </a>
        </li>

        <li class="dropdown {{ setActive(['uploadanh.*', 'anh.*']) }}">
            <a href="#" class="nav-link {{ setActive(['']) }}"><i class="fas fa-image"></i>
                <span>Cập nhật model ảnh</span>
            </a>
        </li>


        <li class="menu-header">Settings & More</li>

        <li
            class="dropdown {{ setActive(['footer-grid-one.*', 'footer-grid-two.*', 'footer-grid-three.*', 'footer-socials.*']) }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                    class="fas fa-th-large"></i><span>Footer</span></a>
            <ul class="dropdown-menu">
                <li class="{{ setActive(['footer-grid-one.index']) }}">
                    <a class="nav-link" href="{{ route('footer-grid-one.index') }}">Footer Grid One</a>
                </li>

                <li class="{{ setActive(['footer-grid-two.*']) }}">
                    <a class="nav-link" href="{{ route('footer-grid-two.index') }}">Footer Grid Two</a>
                </li>

                <li class="{{ setActive(['footer-grid-three.*']) }}">
                    <a class="nav-link" href="{{ route('footer-grid-three.index') }}">Footer Grid Three</a>
                </li>
                <li class="{{ setActive(['footer-socials.*']) }}">
                    <a class="nav-link" href="{{ route('footer-socials.index') }}">Footer Socials</a>
                </li>
            </ul>
        </li>

        {{-- <li class="dropdown {{ setActive(['statistic.doanhthu*']) }}">
            <a class="nav-link {{ setActive(['statistic.doanhthu']) }}" href="{{ route('statistic.doanhthu') }}">
                <i class="fas fa-chart-line"></i>
                <span>Thống kê báo cáo</span>
            </a>
        </li> --}}

        <li class="{{ setActive(['backup.index']) }}">
            <a class="nav-link {{ setActive(['backup.index']) }}" href="{{ route('backup.index') }}">
                <i class="fas fa-cloud-upload-alt"></i>
                <span>Sao lưu và phục hồi</span>
            </a>
        </li>

        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="" onclick="event.preventDefault();
            this.closest('form').submit();"
                    class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i>Đăng xuất
                </a>
            </form>
        </li>
    </aside>
</div>
