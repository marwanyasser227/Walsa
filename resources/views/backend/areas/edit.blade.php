@extends('backend.components.layout')

@section('dash')
<div class="container my-5">
    <h5>تعديل المنطقة </h5>
        <form action="{{ route('areas.update', $area->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">اسم المنطقة</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $area->name }}" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">سعر الشحن</label>
                <input type="number" class="form-control" id="shipmentPrice" name="shipmentPrice"  value="{{ $area->shipmentPrice }}" required>
            </div>
            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
        </form>
    </div>
@endsection
