<div class="container-xl">
    <h2 class="mb-4">Tour 2</h2>
    <div class="row">
        <div class="tour-carousel">
            @for ($i = 0; $i < 12; $i++)
                <div class="col-6 col-sm-3 col-md-3 d-flex product-list">
                    <div class="product-detail" align="center" data-aos="fade-up" data-aos-duration="800">
                        <img src="{{ asset('frontend/images/background4.png') }}" alt="Đà Nẵng" class="img-product">
                        <p class="name-product">Tour Đà Nẵng</p>
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="me-2" style="font-size: 13px">1231212đ</span>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.tour-carousel').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            dots: true,
            arrows: true,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 4500,
            responsive: [{
                    breakpoint: 1024, // laptop
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768, // tablet
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 576, // mobile
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
</script>

<style>
    .slick-prev,
    .slick-next {
        color: white;
        border-radius: 50%;
        /* padding: 10px; */
        z-index: 1;
    }

    .slick-prev {
        left: 0;
    }

    .slick-next {
        right: 0;
    }

    .slick-prev:before,
    .slick-next:before {
        font-size: 40px;
        color: rgb(1, 148, 243);;
    }

    /* .slick-dots li button:before {
        color: #007bff;
    }

    .slick-dots li.slick-active button:before {
        color: #0056b3;
    } */

    .product-list {
        margin-bottom: 30px;
    }

    .name-product {
        margin: 20px 0;
        font-weight: 600;
        font-size: 15px;
    }

    .product-detail {
        padding: 5px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgb(197, 197, 197);
        margin: 0 7px;
    }

    .img-product {
        width: 100%;
        height: 310px;
        border-radius: 8px;
    }
</style>
