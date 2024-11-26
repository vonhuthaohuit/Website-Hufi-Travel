@extends('frontend.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/transactions.css') }}">

    <style>
        .history-link {
            color: #444;
            font-weight: 500;
            padding-left: 15px;
        }

        .history-link.active {
            color: #08c;
            font-weight: 650;
        }

        .transaction-item {
            transition: all linear 0.3s;
        }

        .transaction-item:hover {
            background-color: #daefff;
        }
    </style>
@endpush

@section('renderBody')
    <div class="page-header__bottom">
        <div class="container pt-4">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Giao dịch của tôi</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container py-5" style="min-height: 500px; background-color: #f5f5f5;">
        <div class="row">
            <div class="col-md-4 sidebar">
                <h3 class="mb-3">Trạng thái giao dịch</h3>
                <div class="d-flex flex-column">
                    <a class="history-link {{ setActive(['transaction']) }}" href="{{ route('transaction') }}">Chưa hoàn
                        tất</a>
                    <a class="history-link {{ setActive(['tour.tour-booked']) }}"
                        href="{{ route('tour.tour-booked') }}">Tour đã
                        đặt</a>
                    <a class="history-link {{ setActive(['tour.tour-canceled']) }}"
                        href="{{ route('tour.tour-canceled') }}">Tour đã
                        hủy</a>
                </div>

            </div>

            <div class="col-md-8">
                @yield('content-history')
            </div>
        </div>
    </div>
@endsection
