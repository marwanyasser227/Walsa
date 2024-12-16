@extends('components.appLayout')
@section('content')
    <!-- Start Page Component -->
    <!-- Row -->
    <div class="row main-container border border-1 py-5 px-4 rounded-1" >
        <!-- Login Form Section -->

        <div class="col-md-6">
            @include('components.auth.hellomessage')
            <!-- Form-->
            <div class="form my-5 ">
                <form action="{{route('register.store')}}" method="POST">
                    @csrf <!-- to secure the request -->
                    <div class="my-4">
                        <label for="exampleFormControlInput1" class="form-label">الاسم الكريم</label>
                        <input type="text" class="form-control form-control-lg rounded-1" name ='name' id="exampleFormControlInput1"
                            placeholder="مروان ياسر">
                    </div>
                    <div class="my-4">
                        <label for="exampleFormControlInput1" class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control form-control-lg rounded-1" name ='email' id="exampleFormControlInput1"
                            placeholder="name@example.com">
                    </div>
                    <div class="my-4">
                        <label for="exampleFormControlInput1" class="form-label">رقم الهاتف</label>
                        <input type="tel" class="form-control form-control-lg rounded-1" name ='phone' id="exampleFormControlInput1"
                            placeholder="+201024392440">
                    </div>

                    <div class="my-4">
                        <label for="exampleFormControlInput1" class="form-label">كلمة المرور</label>
                        <input type="password" class="form-control form-control-lg rounded-1" name ="password" id="exampleFormControlInput1"
                            placeholder="••••••••">
                    </div>
                    <div class="my-4">
                        <label for="exampleFormControlInput1" class="form-label">أعد كتابة كلمة المرور</label>
                        <input type="password" class="form-control form-control-lg rounded-1" name="password_confirmation" id="exampleFormControlInput1"
                            placeholder="••••••••">

                    </div>
                    <button type="submit" class="btn btn-secondary py-2 w-100 rounded-1">تسجيل حساب جديد</button>

                </form>
            </div>

        </div>
        <!-- End Form Section -->
        <!-- Benefits Section -->
        <div class=" col-md-6  benefits gap-1">
            <div class=" mx-auto benefits_Container">
                <!-- Start Head Message -->
                <div class="head_Message p-0 ">
                    <h4 class="text-start py-2"> كن شريكًا لنجاحنا 😎</h4>
                    <a href="{{route('login')}}" class="btn btn-primary py-3 px-5 w-100 rounded-1">سجل دخولك
                        </a>
                </div>
                <!-- End Head Message -->
                <!-- Start Benefits-->

                @include('components.auth.benefits')
                <!-- End Benefits-->
            </div>
            <!-- end of Container-Card -->
        </div>
        <!-- End Benefits Section -->


    </div>

    <!-- End Row-->
@endsection
