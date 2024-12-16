@extends('backend.components.layout')

@section('dash')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded">
                <!-- رأس البطاقة -->
                <div class="card-header bg-gradient text-white text-center py-4" style="background: linear-gradient(45deg, #6a11cb, #2575fc);">
                    <h3 class="mb-0">تفاصيل التوصية</h3>
                </div>

                <!-- محتوى البطاقة -->
                <div class="card-body p-4">
                    <!-- صورة الشخص -->
                    <div class="text-center mb-4">
                        <img
                            src="{{$testimonial->image == null ? asset('assets/avatar.jpg') : asset($testimonial->image) }}"
                            alt="{{ $testimonial->name }}"
                            class="img-fluid rounded-circle shadow-sm"
                            style="max-width: 150px; height: 150px; border: 5px solid #e9ecef;"
                        >
                    </div>

                    <!-- اسم الشخص والمسمى الوظيفي -->
                    <div class="text-center mb-3">
                        <h4 class="fw-bold text-dark">{{ $testimonial->name }}</h4>
                        <h6 class="text-muted">{{ $testimonial->jobTitle }}</h6>
                    </div>

                    <!-- خط فاصل أنيق -->
                    <hr class="my-4" style="border-top: 2px solid;">

                    <!-- محتوى التوصية -->
                    <div class="mb-4">
                        <h5 class="fw-bold text-dark">التوصية:</h5>
                        <p class="text-secondary fs-5">{{ $testimonial->message }}</p>
                    </div>

                    <!-- زر العودة -->
                    <div class="text-center">
                        <a href="{{ route('dashboard.testimonails') }}" class="btn btn-outline-primary btn-lg">
                            العودة إلى القائمة
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
