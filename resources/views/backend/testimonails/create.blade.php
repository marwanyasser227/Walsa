@extends('backend.components.layout')
@section('dash')
    <!-- Get Page Components-->


    <!-- Shipment Form -->

    <form action="{{ route('testimonail.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <p class="mt-4 text-secondary fs-6">المعلومات الأساسية</p>
        <div class="col-md-12">
            <label for="name" class="form-label">اسم الشخص</label>
            <input type="text" class="form-control" id="person_name" name="name" required
                >
        </div>
        <div class="col-md-12">
            <label for="jobTitle" class="form-label">المسمي الوظيفي</label>
            <input type="text" class="form-control" id="jobTitle" name="jobTitle" required
                >
        </div>
        <div class="col-md-12">
            <label for="image" class="form-label">الصورة</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*"">
            <div class="mt-3">
                <img id="imagePreview" src="#" alt="Preview Image" style="max-width: 200px; display: none;" />
            </div>
        </div>

        <div class="col-md-12">
            <label for="recipient_name" class="form-label">التوصية</label>
            <textarea type="text" class="form-control" id="message" name="message" required
                ></textarea>
        </div>


        <!-- Submit Button -->
        <div class="text-end mt-4">
            <button type="submit" class="btn btn-dark btn-md">إنشاء توصية</button>
        </div>
    </form>

    </div>
@endsection
