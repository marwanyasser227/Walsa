@extends('components.appLayout')
@section('content')
    <div class=" main-container row border border-1 rounded-1 py-5 px-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-success">الرئيسية</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-success">شحناتي</a></li>
                <li class="breadcrumb-item active" aria-current="page">شحنة رقم : {{ $shipment->id }} </li>
            </ol>
        </nav>
        <!-- End Breadcrumb -->

        <!-- Package Details -->
        @include('components.shipments.shipmentDetails')
        <!-- Package Details -->

        <!-- Progress Bar Section -->
        @include('components.shipments.progress')
        <!-- Progress Bar Section -->

        </div>
    @endsection
