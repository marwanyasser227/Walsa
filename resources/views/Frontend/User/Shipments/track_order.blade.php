@extends('components.appLayout')
@section('content')
    <!-- Start Page Component -->
    <!-- Row -->
    <div class="row main-container border border-1 py-5 px-4 rounded-1 container-track">

        <!-- BreadCrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-3">
                <li class="breacrumb-item-style breadcrumb-item"><a href="#">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">تتبع الطلب</li>
            </ol>
        </nav>
        <!-- BreadCrumb -->

        <!-- Head Area -->
        @include('components.auth.hellomessage')
        <!-- End Head Area -->
        <!-- Start Track Form -->
        <form action="{{route('track.order')}}" class="row track-form" method="POST">
            @csrf
            @method('POST')
            <div class="my-4 col-md-6 ">
                <label for="exampleFormControlInput1" class="form-label">البريد الإلكتروني</label>
                <input type="email" name ='email' class="form-control form-control-lg rounded-1" id="exampleFormControlInput1"
                    placeholder="name@example.com">
            </div>
            <div class="my-4 col-md-6">
                <label for="exampleFormControlInput1" class="form-label">رقم التتبع</label>
                <input type="text" name ='trackOrder' class="form-control form-control-lg rounded-1" id="exampleFormControlInput1"
                    placeholder="MSH-252543">
            </div>
            <div>
                <button type="submit" class="btn btn-secondary py-2  rounded-1">تتبع الطلب</button>

            </div>

        </form>
        <!-- End Track Form -->
        <div class="bg-icon">
            <i class="bi bi-geo-alt-fill" ></i>

        </div>

    </div>

    <!-- End Row-->
@endsection
