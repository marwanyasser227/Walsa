@extends('components.appLayout')

@section('content')
    <div class="container my-5 border border-1 rounded-1 px-4 py-5">
        <h3 class="text-center mb-4">فروعنا📌</h3>

        <!-- BreadCrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-3">
                <li class="breacrumb-item-style breadcrumb-item"><a href="#">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">فروعنا</li>
            </ol>
        </nav>
        <!-- BreadCrumb-->

        @if (count($hubs) > 0 || $hubs == null)
            <!-- Branch Carousel -->
            @include('components.hubs.branchs')
            <!-- Branch Carousel -->

            <!-- Map Section -->
            @include('components.hubs.maps')
            <!-- Map Section -->
            
        @else
        <h3 class="vh-50 rounded-2 py-5 text-center" style="background-color: #56c8a426;   padding:26px;">عفوا لا يوجد فروع🤷‍♂️</h3>
        @endif

    </div>
@endsection
