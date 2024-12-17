@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Hình ảnh tour</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chỉnh sửa hình ảnh</h4>
                            <div class="card-header-action">
                                <a href="{{ route('hinhanhtour.index', ['tour_id' => $hinhanhtour->matour]) }}" class="btn btn-primary"><i
                                        class="fas fa-arrow-left"></i>
                                    Quay về</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('hinhanhtour.update', $hinhanhtour->mahinhanh) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- <div class="form-group">
                                    <label>Tour</label>
                                    <select class="form-control" name="matour" required>
                                        <option value="">Chọn tour</option>
                                        @foreach ($tours as $item)
                                            <option value="{{ $item->matour }}"
                                                @if ($item->matour == old('matour', $selectedTour)) selected @endif>
                                                {{ $item->tentour }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                {{-- <div class="form-group">
                                    <label>Tên hình ảnh</label>
                                    <input type="text" class="form-control" name="tenhinh" required
                                        value="{{ $hinhanhtour->tenhinh }}">
                                </div> --}}

                                <input type="hidden" name="matour" value="{{ $hinhanhtour->matour }}">
                                <input type="hidden" name="tenhinh" value="{{ $hinhanhtour->tentour }}" hidden>


                                <div class="form-group">
                                    <label>Hình ảnh tour</label>
                                    <input type="file" class="form-control" name="duongdan" multiple>
                                    <img src="{{ asset($hinhanhtour->duongdan) }}" width="100" alt="Current Image">
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
