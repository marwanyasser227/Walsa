@extends('backend.components.layout')

@section('dash')
<div class="card">
    <div class="card-header">إنشاء مستودع جديد</div>
    <div class="card-body">
        <form action="{{ route('hubs.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name_ar">اسم المستودع</label>
                <input type="text" name="name_ar" id="name_ar" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">العنوان</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="city_id">المدينة</label>
                <select name="city_id" id="city_id" class="form-control" required>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="map">الخريطة</label>
                <input type="text" name="map" id="map" class="form-control" placeholder="قم بكتابة الرابط بدون تاغ iframe" required>
            </div>
            <button type="submit" class="mt-5 btn btn-success">حفظ</button>
        </form>
    </div>
</div>
@endsection
