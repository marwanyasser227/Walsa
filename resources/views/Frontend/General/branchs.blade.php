@extends('components.appLayout')

@section('content')
    <div class="container my-5 border border-1 rounded-1 px-4 py-5">
        <h2 class="text-center mb-4">فروعنا📌</h2>

        <!-- BreadCrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-3">
                <li class="breacrumb-item-style breadcrumb-item"><a href="#">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">فروعنا</li>
            </ol>
        </nav>
        <!-- BreadCrumb-->
        <!-- Branch Carousel -->
        @include('components.hubs.branchs')
        <!-- Branch Carousel -->

        <!-- Map Section -->
        @include('components.hubs.maps')
        <!-- Map Section -->
    </div>
@endsection
