@extends('backend.components.layout')

@section('dash')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded">
                <!-- رأس البطاقة -->
                <div class="card-header bg-gradient text-white text-center py-4" style="background: linear-gradient(45deg, #6a11cb, #2575fc);">
                    <h3 class="mb-0">تفاصيل الرسالة</h3>
                </div>

                <!-- محتوى البطاقة -->
                <div class="card-body p-4">

                    <!-- اسم الشخص والمسمى الوظيفي -->
                    <div class="text-center mb-3">
                        <h4 class="fw-bold text-dark">{{ $contact->name }}</h4>
                        <h6 class="text-muted">{{ $contact->email }}</h6>
                        <h6 class="text-muted">{{ $contact->phone }}</h6>
                    </div>

                    <!-- خط فاصل أنيق -->
                    <hr class="my-4" style="border-top: 2px solid;">

                    <!-- محتوى التوصية -->
                    <div class="mb-4">
                        <p class="text-secondary fs-5">{{ $contact->message }}</p>
                    </div>

                    <!-- زر العودة -->
                    <div class="text-center">
                        <a href="{{ route('contact.index') }}" class="btn btn-outline-primary btn-lg">
                            العودة إلى القائمة
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
