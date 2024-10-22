<div>
    <div class="w-100" style="position: relative;">
        <img src="../../frontend/images/background.png" alt="" width="100%" height="550px"
            style="opacity: 1; z-index: 0; position: relative;">
        <div>
            <div class="banner-thumb">
                <div class="banner-slogan">
                    <p>Chuyến đi mơ ước, nơi hành trình trở thành kỷ niệm!</p>
                    <?php 
            $message = Session::get('name') ;
            if($message)
              {
                echo "<span style='color: red;margin-left:30px; font-weight: bold;margin-left:170px'>$message</span>";
                Session::put('message',null); 
              }
            ?>
                </div>

                @include('frontend.home.component.bannerBackground')
            </div>

        </div>

    </div>

    <div class="container-xl">
        <div class="border-radius-top-left-right">
        </div>

        <img src="../../frontend/images/banner_sale.png" alt="sale"
            style="width: 100%; height: 140px; border-radius: 12px; z-index: 2;" class="mb-4">
        <h2 class="mb-4">Tour</h2>
        <div class="row">
            @for ($i = 0; $i < 4; $i++)
                <div class="col-6 col-sm-3 col-md-3 d-flex product-list">
                    <div class="product-detail" align="center" data-aos="fade-up" data-aos-duration="800">
                        <img src="{{ asset('frontend/images/DaNang.png') }}" alt="Đà Nẵng" class="img-product">
                        <p class="name-product">Tour Đà Nẵng</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2" style="font-size: 13px">1231212đ</span>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>



    <div class="container-xl">
        <h2 class="mb-4">Tour</h2>
        <div class="row">
            @for ($i = 0; $i < 4; $i++)
                <div class="col-6 col-sm-3 col-md-3 d-flex product-list">
                    <div class="product-detail" align="center" data-aos="fade-up" data-aos-duration="800">
                        <img src="{{ asset('frontend/images/NhaTrang.png') }}" alt="Đà Nẵng" class="img-product">
                        <p class="name-product">Tour Đà Nẵng</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2" style="font-size: 13px">1231212đ</span>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    @include('frontend.home.component.background')
</div>

<style>
    .product-list {
        float: right;
        margin-bottom: 30px;

    }

    .product-link {
        text-decoration: none;
        color: #585858;
    }

    .name-product {
        margin: 20px 0 20px 0;
        font-weight: 600;
        font-size: 15px;
    }

    .product-detail {
        padding: 5px;
        width: 100%;
        position: relative;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgb(197, 197, 197);
    }

    .img-product {
        width: 100%;
        height: 310px;
        display: block;
        padding: 5px;
        border-radius: 8px;
    }


    .border-radius-top-left-right {
        border-top-left-radius: 9999px;
        border-top-right-radius: 9999px;
        height: 30px;
        background-color: rgba(255, 255, 255, 1.00);
        margin-top: -30px;
        z-index: 1;
        position: absolute;
        left: 0;
        right: 0;
    }

    .banner-thumb {
        position: absolute;
        top: 130px;
        width: 100%;
    }

    .banner-slogan {
        display: flex;
        justify-content: center;
        width: 100%;
        font-size: 28px;
        color: #fff;
        font-weight: 700;
    }

    .nav-tabs .nav-link.active {
        border-radius: 9999px;
        margin-bottom: 8px;
    }

    .nav-tabs .nav-link.active svg path {
        fill: #000;
        stroke: #000;
    }

    .nav-tabs .nav-link {
        color: #fff;
        font-weight: 700;
        margin: 0 10px 0 10px;
        border-radius: 9999px;
    }

    .nav-tabs .nav-link:hover {
        border-radius: 9999px;
    }
</style>
