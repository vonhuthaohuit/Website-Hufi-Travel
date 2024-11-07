@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tour</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa thông tin khách sạn</h4>
                            <div class="card-header-action">
                                <a href="{{ route('khachsan_tour.index',['tour_id'=>$khachsan_tour->matour]) }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('khachsan_tour.update', $khachsan_tour->matour) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $khachsan_tour->matour }}" name="tour_id">
                                <input type="hidden" value="{{ $khachsan_tour->makhachsan }}" name="makhachsan_id">
                                <div class="row">
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Khách sạn</label>
                                            <select class="form-control" name="makhachsan">
                                                    @foreach ($khachsan as $khachsan_item)
                                                        <option value="{{ $khachsan_item->madiemdulich }}"
                                                            @if(isset($khachsan_tour) && $khachsan_tour->makhachsan == $khachsan_item->makhachsan) selected @endif>
                                                            {{ $khachsan_item->tenkhachsan }}

                                                        </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Khách sạn</label>
                                            <p>{{ $khachsan_tour->khachsan->tenkhachsan }}</p> <!-- Hoặc dùng <span> -->
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Vị trí phòng\khu vực</label>
                                            <input type="text" class="form-control" name="vitriphong"
                                                value="{{$khachsan_tour->vitriphong }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sức chứa</label>
                                            <input type="number" class="form-control" name="succhua"
                                                value="{{$khachsan_tour->succhua }}"  required>
                                        </div>
                                    </div>


                                </div>

                                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

{{-- @push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush --}}
