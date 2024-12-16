@extends('backend.components.layout')
@section('dash')

        <!-- Package Details -->
        @include('backend.components.shipments.details')
        <!-- Package Details -->

        <!-- Progress Bar Section -->
        @include('backend.components.shipments.progressbar')
        <!-- Progress Bar Section -->

    @endsection
