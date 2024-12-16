@extends('components.appLayout')

@section('content')
    <div class="contact-us-container margin-0">
        <!-- Map Section -->
        @include('components.contact.map')
        <!-- End Map Section -->

        <!-- Contact Form Section -->
        @include('components.contact.contact')
        <!-- End Contact Form Section -->
    </div>
@endsection
