@extends('backend.components.layout')

@section('dash')
<div class="container my-5">
    <h5>تعديل المدينة </h5>
        <form action="{{ route('cities.update', $city->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">اسم المدينة</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $city->name }}" required>
            </div>
            <div class="mb-3">
                <label for="area_id" class="form-label">اختر المحافظة</label>
                <select class="form-select p-3" id="area_id" name="area_id">
                    @foreach($governates as $gov)
                        <option value="{{ $gov->id }}"
                            {{ $city->governate->id == $gov->id ? 'selected' : '' }}>
                            {{ $gov->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
        </form>
    </div>
@endsection
