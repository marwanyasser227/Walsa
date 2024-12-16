@extends('backend.components.layout')

@section('dash')
    <div class="container my-5">
        <h5>تعديل بيانات {{$partner->name}}</h5>
        <form action="{{ route('partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">اسم الشريك</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ $partner->name }}">
            </div>
            <div class="col-md-12">
                <label for="image" class="form-label">صورة الشريك</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                <div class="my-3">
                    @if ($partner->image)
                        <img id="imagePreview" src="{{ asset($partner->image) }}" alt="Preview Image"
                            style="max-width: 200px;" />
                    @else
                        <img id="imagePreview" src="#" alt="Preview Image"
                            style="max-width: 200px; display: none;"  />
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-primary">حفظ</button>
        </form>
    </div>
@endsection
