@extends('backend.components.layout')

@section('dash')
    <div class="container my-5">
        <h5>اضافة مدينة جديدة</h5>
        <form action="{{ route('cities.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">اسم المدينة</label>
                <input type="text" class="form-control" id="name" name="name"  required>
            </div>
            <div class="mb-3">
                <label for="area_id" class="form-label">اختر المحافظة</label>
                <select class="form-select p-3" id="governate_id" name="governate_id">
                    @foreach ($governates as $governate)
                        <option value="{{ $governate->id }}">{{ $governate->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">حفظ</button>
        </form>
    </div>
@endsection
