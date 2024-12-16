@extends('backend.components.layout')
@section('dash')
    <!-- Edit Page Components-->

    <!-- Shipment Form -->
    <form action="{{ route('testimonail.update', $testimonail->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <p class="mt-4 text-secondary fs-6">المعلومات الأساسية</p>

        <div class="col-md-12">
            <label for="name" class="form-label">اسم الشخص</label>
            <input type="text" class="form-control" id="person_name" name="name" value="{{ old('name', $testimonail->name) }}" required>
        </div>

        <div class="col-md-12">
            <label for="jobTitle" class="form-label">المسمي الوظيفي</label>
            <input type="text" class="form-control" id="jobTitle" name="jobTitle" value="{{ old('jobTitle', $testimonail->jobTitle) }}" required>
        </div>

        <div class="col-md-12">
            <label for="image" class="form-label">الصورة</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <div class="mt-3">
                @if($testimonail->image)
                    <img id="imagePreview" src="{{ asset($testimonail->image) }}" alt="Preview Image" style="max-width: 200px;" />
                @else
                    <img id="imagePreview" src="#" alt="Preview Image" style="max-width: 200px; display: none;" />
                @endif
            </div>
        </div>

        <div class="col-md-12">
            <label for="message" class="form-label">التوصية</label>
            <textarea class="form-control" id="message" name="message" required>{{ old('message', $testimonail->message) }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="text-end mt-4">
            <button type="submit" class="btn btn-dark btn-md">تحديث التوصية</button>
        </div>
    </form>

@endsection
