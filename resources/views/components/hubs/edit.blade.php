@extends('backend.components.layout')

@section('dash')
<div class="card">
    <div class="card-header">تعديل مستودع</div>
    <div class="card-body">
        <form action="{{ route('hubs.update', $hub->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name_ar">اسم المستودع</label>
                <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{ $hub->name_ar }}" required>
            </div>
            <div class="form-group">
                <label for="address">العنوان</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ $hub->address }}" required>
            </div>
            <div class="form-group">
                <label for="city_id">المدينة</label>
                <select name="city_id" id="city_id" class="form-control" required>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" {{ $hub->city_id == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="map">الخريطة</label>
                <input type="text" name="map" id="map" class="form-control"
                       value="{{ $hub->map->map ?? '' }}"
                       placeholder="قم بكتابة الرابط بدون تاغ iframe" required>
            </div>
            <button type="submit" class="mt-5 btn btn-primary">تحديث</button>
        </form>
    </div>
</div>
@endsection
