@extends('components.appLayout')
@section('content')
    <!-- Start Page Component -->
    <div class="container my-5 border border-1 rounded-1 px-4 py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-success">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">شحناتي</li>
            </ol>
        </nav>
        <!-- End Breadcrumb -->
        <!-- End Shipment List -->
        @include('components.shipments.myshipments')
        <!-- End Shipment List -->
    </div>
    <!-- End Container -->
    @endsection
