@push('style')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/smoothness/jquery-ui.css">
@endpush
@php
    $loaiTours = \App\Models\LoaiTour::layTatCaLoaiTour();
@endphp
<section class="tour-search">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="tour-search-box">
                    <form action="{{ route('tour.searchbox') }}" method="POST" class="tour-search-one">
                        @csrf
                        <div class="tour-search-one__inner">
                            <div class="tour-search-one__inputs">
                                <div class="tour-search-one__input-box">
                                    <label for="place">Điểm đến</label>
                                    <input type="text" placeholder="Nhập điểm đến" name="name-destination"
                                        id="name-destination">
                                </div>
                                <div class="tour-search-one__input-box">
                                    <label>Thời gian</label>
                                    <input type="" placeholder="Nhập thời gian đi" name="date-start"
                                        id="datepicker" class="">
                                </div>
                                <div class="tour-search-one__input-box tour-search-one__input-box-last">
                                    <label for="typetour">Loại tour</label>
                                    <select name="typetour" class="form-select" id="typetour">
                                        <option value="">Chọn loại tour</option>
                                        @foreach ($loaiTours as $loaiTour)
                                            <option value="{{ $loaiTour->maloaitour }}">{{ $loaiTour->tenloai }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="tour-search-one__btn-wrap">
                                <button type="submit" class="thm-btn tour-search-one__btn">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            document.getElementById('imageUploadForm').addEventListener('submit', async function(event) {
                event.preventDefault();

                const formData = new FormData();
                const imageInput = document.getElementById('imageInput');
                formData.append('image', imageInput.files[0]);

                try {
                    const response = await fetch("{{ route('search.image') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const result = await response.json();

                    if (response.ok) {
                        document.getElementById('result').innerHTML = '<h2>Similar Images:</h2>' + result.map(img =>
                            `<p>${img}</p>`).join('');
                    } else {
                        document.getElementById('result').innerText = result.error || 'Error occurred!';
                    }
                } catch (error) {
                    console.error('Error:', error);
                    document.getElementById('result').innerText = 'An error occurred while processing the image.';
                }
            });
        </script>
    @endpush

    @push('style')
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/smoothness/jquery-ui.css">

        <style>
            .form-select {
                border: none;
            }
        </style>
    @endpush
    @push('script')
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
        <script>
            $(function() {
                $("#datepicker").datepicker({
                    dateFormat: "dd/mm/yy"
                });
            });
        </script>
    @endpush

</section>
