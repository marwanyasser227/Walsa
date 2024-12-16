@extends('backend.components.layout')

@section('dash')
    <div class="container my-5">
        <h5>تعديل المحافظة </h5>
        <form action="{{ route('governorates.update', $governorate->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Metodo HTTP per aggiornare i dati --}}
            <div class="mb-3">
                <label for="name" class="form-label">اسم المحافظة</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $governorate->name }}" required>
            </div>
            <div class="mb-3">
                <label for="area_id" class="form-label">اختر المناطق</label>
                <select class="form-select p-3" id="area_id" name="area_id">
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}"
                            {{ $governorate->area_id == $area->id ? 'selected' : '' }}>
                            {{ $area->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
        </form>
    </div>
@endsection
