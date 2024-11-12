<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href=""><img src="{{ asset('frontend/images/logo.png') }}" alt="HUFI Travel" width="50px"> HUFI
                Travel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href=""><img src="{{ asset('frontend/images/logo.png') }}" alt="HUFI Travel" width="30px"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ setActive(['dashboard']) }}">
                <a href="{{ route('dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Manager tours</li>
            <li
                class="dropdown {{ setActive([
                    'tour.*',
                    'loaitour.*',
                    'khuyenmai.*',
                    'admin.products-image-gallery.*',
                    'admin.products-variant.*',
                    'admin.products-variant-item.*',
                    'admin.seller-products.*',
                    'admin.seller-pending-products.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i>
                    <span>Manage Tours</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['tour.*']) }}">
                        <a class="nav-link" href="{{ route('tour.index') }}">Tours</a>
                    </li>
                    <li class="{{ setActive(['loaitour.*']) }}">
                        <a class="nav-link" href="{{ route('loaitour.index') }}">Tour Categoty</a>
                    </li>
                    <li class="{{ setActive(['khuyenmai.*']) }}">
                        <a class="nav-link" href="{{ route('khuyenmai.index') }}">Coupons</a>
                    </li>
                    <li class="{{ setActive(['diemdulich.*']) }}">
                        <a class="nav-link" href="{{ route('diemdulich.index') }}">Tourist Spot</a>
                    </li>
                    <li class="{{ setActive(['admin.seller-pending-products.*']) }}">
                        <a class="nav-link" href="">Seller Pending Products</a>
                    </li>

                    <li class="{{ setActive(['admin.reviews.*']) }}">
                        <a class="nav-link" href="">Product Reviews</a>
                    </li>

                </ul>
            </li>

            <li
                class="dropdown {{ setActive([
                    'admin.order.*',
                    'admin.pending-orders',
                    'admin.processed-orders',
                    'admin.dropped-off-orders',
                    'admin.shipped-orders',
                    'admin.out-for-delivery-orders',
                    'admin.delivered-orders',
                    'admin.canceled-orders',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cart-plus"></i>
                    <span>Manager Service</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['khachsan.*']) }}"><a class="nav-link" href="{{ route('khachsan.index') }}">Hotel</a>
                    </li>
                    <li class="{{ setActive(['phuongtien.*']) }}"><a class="nav-link" href="{{ route('phuongtien.index') }}">
                        Vehicle</a></li>
                    <li class="{{ setActive(['admin.processed-orders']) }}"><a class="nav-link" href="">All
                            processed Orders</a></li>
                    <li class="{{ setActive(['admin.dropped-off']) }}"><a class="nav-link" href="">All Dropped
                            Off Orders</a></li>

                    <li class="{{ setActive(['admin.shipped-orders']) }}"><a class="nav-link" href="">All
                            Shipped Orders</a></li>
                    <li class="{{ setActive(['admin.out-for-delivery-orders']) }}"><a class="nav-link"
                            href="">All Out For Delivery Orders</a></li>


                    <li class="{{ setActive(['admin.delivered-orders']) }}"><a class="nav-link" href="">All
                            Delivered Orders</a></li>

                    <li class="{{ setActive(['admin.canceled-orders']) }}"><a class="nav-link" href="">All
                            Canceled Orders</a></li>

                </ul>
            </li>

            <li class="{{ setActive(['admin.transaction']) }}"><a class="nav-link" href=""><i
                        class="fas fa-money-bill-alt"></i>
                    <span>Transactions</span></a>
            </li>

            <li
                class="dropdown {{ setActive([
                    'admin.vendor-profile.*',
                    'admin.coupons.*',
                    'admin.shipping-rule.*',
                    'admin.payment-settings.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Ecommerce</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link" href="">Flash
                            Sale</a></li>
                    <li class="{{ setActive(['admin.coupons.*']) }}"><a class="nav-link" href="">Coupons</a>
                    </li>
                    <li class="{{ setActive(['admin.shipping-rule.*']) }}"><a class="nav-link" href="">Shipping
                            Rule</a></li>
                    <li class="{{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link" href="">Vendor
                            Profile</a></li>
                    <li class="{{ setActive(['admin.payment-settings.*']) }}"><a class="nav-link"
                            href="">Payment Settings</a></li>

                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.withdraw-method.*', 'admin.withdraw.index']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-wallet"></i>
                    <span>Phân công công việc</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ setActive(['admin.withdraw-method.*']) }}"><a class="nav-link"
                            href="">aaaaa</a></li>

                    <li class="{{ setActive(['admin.withdraw.index']) }}"><a class="nav-link"
                            href="">Withdraw List</a></li>

                </ul>
            </li>

            <li
                class="dropdown {{ setActive([
                    'admin.slider.*',
                    'admin.vendor-condition.index',
                    'admin.about.index',
                    'admin.terms-and-conditions.index',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i>
                    <span>Manage Website</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link" href="">Slider</a>
                    </li>

                    <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link" href="">Home Page
                            Setting</a></li>

                    <li class="{{ setActive(['admin.vendor-condition.index']) }}"><a class="nav-link"
                            href="">Vendor Condition</a></li>
                    <li class="{{ setActive(['admin.about.index']) }}"><a class="nav-link" href="">About
                            page</a></li>
                    <li class="{{ setActive(['admin.terms-and-conditions.index']) }}"><a class="nav-link"
                            href="">Terms Page</a></li>

                </ul>
            </li>

            <li><a class="nav-link {{ setActive(['admin.advertisement.*']) }}" href=""><i
                        class="fas fa-ad"></i>
                    <span>Advertisement</span></a></li>

            <li class="dropdown {{ setActive(['loaiblog.*', 'blog.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fab fa-blogger-b"></i> <span>Manage Blog</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ setActive(['loaiblog*']) }}"><a class="nav-link"
                            href="{{ route('loaiblog.index') }}">Blog Categories</a></li>
                    <li class="{{ setActive(['blog.*']) }}"><a class="nav-link"
                            href="{{ route('blog.index') }}">Blogs</a></li>
                </ul>
            </li>

            <li><a class="nav-link {{ setActive(['admin.messages.index']) }}" href=""><i
                        class="fas fa-user"></i>
                    <span>Messages</span></a></li>
        </ul>

    </aside>
</div>
