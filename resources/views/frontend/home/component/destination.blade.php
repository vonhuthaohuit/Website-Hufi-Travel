{{-- start destination --}}
{{-- <section class="destinations-one">
    <div class="container-xl">
        <div class="section-title text-center">
            <span class="section-title__tagline">Destination lists</span>
            <h2 class="section-title__title">Danh sách điểm đến</h2>
        </div>
        <div class="row masonary-layout">
            <div class="col-xl-3 col-lg-3">
                <div class="destinations-one__single">
                    <div class="destinations-one__img">
                        <img src="{{ asset('frontend/images/destination-1-1.png') }}" alt="Spain" loading="lazy">
                        <div class="destinations-one__content">
                            <h2 class="destinations-one__title"><a href="destinations-details.html">Spain</a></h2>
                        </div>
                        <div class="destinations-one__button">
                            <a href="#">6 tours</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="destinations-one__single">
                    <div class="destinations-one__img">
                        <img src="{{ asset('frontend/images/destination-1-2.png') }}" alt="Thailand" loading="lazy">
                        <div class="destinations-one__content">
                            <p class="destinations-one__sub-title">Wildlife</p>
                            <h2 class="destinations-one__title"><a href="destinations-details.html">Thailand</a></h2>
                        </div>
                        <div class="destinations-one__button">
                            <a href="#">6 tours</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3">
                <div class="destinations-one__single">
                    <div class="destinations-one__img">
                        <img src="{{ asset('frontend/images/destination-1-3.png') }}" alt="Africa" loading="lazy">
                        <div class="destinations-one__content">
                            <h2 class="destinations-one__title"><a href="destinations-details.html">Africa</a></h2>
                        </div>
                        <div class="destinations-one__button">
                            <a href="#">6 tours</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6">
                <div class="destinations-one__single">
                    <div class="destinations-one__img">
                        <img src="{{ asset('frontend/images/destination-1-4.png') }}" alt="Australia" loading="lazy">
                        <div class="destinations-one__content">
                            <h2 class="destinations-one__title"><a href="destinations-details.html">Australia</a></h2>
                        </div>
                        <div class="destinations-one__button">
                            <a href="#">6 tours</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="destinations-one__single">
                    <div class="destinations-one__img">
                        <img src="{{ asset('frontend/images/destination-1-5.png') }}" alt="Switzerland" loading="lazy">
                        <div class="destinations-one__content">
                            <p class="destinations-one__sub-title">Adventure</p>
                            <h2 class="destinations-one__title"><a href="destinations-details.html">Switzerland</a></h2>
                        </div>
                        <div class="destinations-one__button">
                            <a href="#">6 tours</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}


{{-- start destination --}}
<section class="destinations-one">
    <div class="container-xl">
        <div class="section-title text-center">
            <span class="section-title__tagline">Destination lists</span>
            <h2 class="section-title__title">Danh sách điểm đến</h2>
        </div>
        <div class="destinations-two-shape wow slideInLeft animated" data-wow-delay="100ms" data-wow-duration="2500ms"
            style="visibility: visible; animation-duration: 2500ms; animation-delay: 100ms; animation-name: slideInLeft;">
            <img src="{{ asset('frontend/images/destinations-two-shape.png') }}" alt="">
        </div>
        <div class="row masonary-layout">
            @foreach ($destinations as $item => $destination)
                @php
                    $index = $item + 1;
                    $columnClass = $index == 1 || $index == 3 ? 'col-xl-3 col-lg-3' : 'col-xl-6 col-lg-6';
                @endphp

                <div class="{{ $columnClass }}">
                    <a href="{{ route('tour.byDestination', $destination->tendiemdulich) }}">
                        <div class="destinations-one__single">
                            <div class="destinations-one__img">
                                <img src="{{ asset('frontend/images/destination-1-' . $index . '.png') }}"
                                     alt="{{ $destination->tendiemdulich }}" loading="lazy">
                            </div>
                            <div class="destinations-one__content">
                                <h2 class="destinations-one__title">
                                    <a href="{{ route('tour.byDestination', $destination->tendiemdulich) }}">{{ $destination->tendiemdulich }}</a>
                                </h2>
                            </div>
                            <div class="destinations-one__button">
                                <a href="{{ route('tour.byDestination', $destination->tendiemdulich) }}">{{ $destination->total_tours }} tours</a>
                            </div>
                        </div>
                    </a>
                </div>

            @endforeach
        </div>
    </div>
</section>
{{-- end destination --}}
