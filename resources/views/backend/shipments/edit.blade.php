@extends('backend.components.layout')
@section('dash')
    <!-- Get Page Components-->


    <!-- Shipment Form -->
    <!-- Status Information -->
    @include('backend.components.shipments.status')
    <!-- Status Information -->

    <form action="{{ route('shipment.Update', $shipment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- Package Details -->
        @include('backend.components.shipments.package')
        <!-- Package Details -->




        <!-- Submit Button -->
        <div class="text-end mt-4">
            <button type="submit" class="btn btn-dark btn-md">تحديث الطلبية</button>
        </div>
    </form>

    </div>

@endsection
