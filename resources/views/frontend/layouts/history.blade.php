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
                <h3 class="mb-3">Giao dịch đang tiến hành</h3>
                {{-- <button class="btn btn-primary d-flex justify-start">
                    <svg class="me-2" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" data-id="IcUserBooking">
                        <path
                            d="M4 7V19C4 20.1046 4.89543 21 6 21H18C19.1046 21 20 20.1046 20 19V7M4 7V5C4 3.89543 4.89543 3 6 3H18C19.1046 3 20 3.89543 20 5V7M4 7H8.5M20 7H12"
                            stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                            d="M16 17H12.5C12.2239 17 12 16.7761 12 16.5C12 16.2239 12.2239 16 12.5 16H16C16.2761 16 16.5 16.2239 16.5 16.5C16.5 16.7761 16.2761 17 16 17Z"
                            stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                            d="M16 12H12.5C12.2239 12 12 11.7761 12 11.5C12 11.2239 12.2239 11 12.5 11H16C16.2761 11 16.5 11.2239 16.5 11.5C16.5 11.7761 16.2761 12 16 12Z"
                            stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M7.5 12V11H8.5V12H7.5Z" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M7.5 17V16H8.5V17H7.5Z" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg> Tất cả giao dịch
                </button> --}}
                <div class="d-flex flex-column">
                    <a class="history-link {{ setActive(['transaction']) }}" href="{{ route('transaction') }}">Chưa hoàn
                        tất</a>
                    <a class="history-link {{ setActive(['tour.tour-booked']) }}"
                        href="{{ route('tour.tour-booked') }}">Tour đã
                        đặt</a>
                </div>

            </div>

            <div class="col-md-8">
                @yield('content-history')
            </div>
        </div>
    </div>
@endsection
