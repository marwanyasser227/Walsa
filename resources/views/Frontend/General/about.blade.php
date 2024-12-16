@extends('components.appLayout')

@section('content')
<div class="border border-1 rounded-1 px-5 py-5 container my-5 abouts-section">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-success">الرئيسية</a></li>
            <li class="breadcrumb-item active" aria-current="page">من نحن</li>
        </ol>
    </nav>
    <!-- End Breadcrumb -->

    <!-- About Us Section -->
    @include('components.about.howus')
    <!-- End About Us Section -->

    <!-- Our Values Section -->
    @include('components.about.values')

    <!-- End Our Values Section -->

    <!-- Contact Us Section -->
    @include('components.about.contact')

    <!-- End Contact Us Section -->
</div>
@endsection
