@extends('components.appLayout')

@section('content')
    <!-- Start Hero Section -->
     @include('components.home.hero') 
    <!-- End Hero Section -->

    <!-- Start Features Section -->
    @include('components.home.features')
    <!-- End Features Section -->

    <!-- Start About Section -->
    @include('components.home.about')
    <!-- End About Section -->

    <!-- Start Call to Action Section -->
    @include('components.home.action')
    <!-- End Call to Action Section -->

    <!-- Services Section -->
    <!-- Start Testimonial Section -->
    @include('components.home.testimonials')
    <!-- End Testimonials Section -->

    <!-- Start Statistics Section -->
    @include('components.home.statics')
    <!-- End Statistics Section -->

    <!-- Start Partners Carousel Section -->
    @include('components.home.partner')
    <!-- End Partners Carousel Section -->

@endsection
