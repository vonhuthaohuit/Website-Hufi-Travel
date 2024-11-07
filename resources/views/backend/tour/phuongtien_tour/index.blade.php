@extends('backend.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Thông tin chi tiết thời gian tour</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tên tour : {{ $tour->tentour }}</h4>

                            <div class="card-header-action">
                                <a id="create-new-btn" href="{{ route('phuongtien_tour.create',['tour_id' => $tour->matour]) }}" class="btn btn-primary" class="btn btn-primary"><i class="fas fa-plus"></i>
                                    Create New</a>
                            </div>
                        </div>

                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    </script>
{{--
    <script>
        $(document).ready(function() {
            $('#tour-select').change(function() {
                var tourID = $(this).val();
                var createUrl = "{{ route('chuongtrinhtour.create', ':tour_id') }}";
                createUrl = createUrl.replace(':tour_id', tourID ? tourID : '');
                $('#create-new-btn').attr('href', createUrl);
            });
        });
    </script> --}}



@endpush
