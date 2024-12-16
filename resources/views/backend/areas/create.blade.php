@extends('backend.components.layout')

@section('dash')
    <div class="container my-5">
        <h5>اضافة منطقة جديدة</h5>
        <form action="{{ route('areas.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">اسم المنطقة </label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">سعر الشحن </label>
                <input type="number" class="form-control" id="shipmentPrice" name="shipmentPrice" required>
            </div>
            <button type="submit" class="btn btn-primary">حفظ</button>
        </form>
    </div>
@endsection
