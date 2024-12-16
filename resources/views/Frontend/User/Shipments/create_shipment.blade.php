@extends('components.appLayout')

@section('content')
    <div class="container my-5">
        <!-- Page Header -->
        <div class="text-start mb-4">
            <h1 class="fs-3">إنشاء شحنة جديدة</h1>
            <p class="text-muted" style="font-size:16px">املئ التفاصيل لإنشاء شحنتك بسهولة.</p>
        </div>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-success">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">إنشاء شحنة</li>
            </ol>
        </nav>
        <!-- End Breadcrumb -->

        <!-- Shipment Form -->
        <form action="{{ route('shipment.store') }}" method="POST" class="border p-4 rounded-3 ">
            @csrf
            <!-- Sender Information -->
            @include('components.shipments.sender')
            <!-- Sender Information -->


            <!-- Recipient Information -->
            @include('components.shipments.reciver')
            <!-- Recipient Information -->

            <!-- Package Details -->
            @include('components.shipments.package')
            <!-- Package Details -->

        </form>
    </div>
@endsection
