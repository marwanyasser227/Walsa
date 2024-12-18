@extends('components.appLayout')
@section('content')
<div class="container text-center py-5">
    <!-- Svg Undraw img -->
    <div class="mb-4">
        <img src="{{asset('assets/site/error404.svg')}}" alt="" class="img-fluid" width="350" height="350">
    </div>

    <!-- 404 Message -->
    <h1 class="display-4 ">404</h1>
    <p class="lead">عذرًا، الصفحة التي تحاول الوصول إليها غير موجودة.</p>
    <p>يمكنك العودة إلى الصفحة الرئيسية أو استخدام شريط التنقل للعثور على ما تبحث عنه.</p>

    <!-- Navigation Buttons -->
    <a href="/" class="btn btn-secondary mt-3">العودة إلى الصفحة الرئيسية</a>
</div>

@endsection
