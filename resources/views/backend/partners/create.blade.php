@extends('backend.components.layout')

@section('dash')
<div class="container">
    <h2>إضافة شريك جديد</h2>
    <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">اسم الشريك</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="col-md-12">
            <label for="image" class="form-label">صورة الشريك</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <div class="mt-3">
                <img id="imagePreview" src="#" alt="Preview Image" style="max-width: 200px; display: none;" />
            </div>
        </div>
        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>
@endsection
