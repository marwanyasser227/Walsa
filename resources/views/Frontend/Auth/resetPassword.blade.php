@extends('components.appLayout')
@section('content')
    <!-- Start Row -->
    <div class="row main-container  border border-1 rounded-1 py-5 px-4">
        <!-- Start Message -->
        <div class="col-12">
            @include('components.auth.Sadmessage')
        </div>
        <!-- End Message -->
        <!-- Start form div-->
        <div class="col-12">
            <div class="form my-5 ">
                <form action="" method="POST">
                    <div class="my-4">
                        <label for="exampleFormControlInput1" class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control form-control-lg rounded-1" id="exampleFormControlInput1"
                            placeholder="name@example.com">
                    </div>

                    <button type="submit" class="btn btn-secondary py-2 rounded-1">استعادة كلمة المرور</button>

                </form>
            </div> <!-- End Form Container -->
        </div>
        <!-- End Form div -->
    </div>
    <!-- End Row -->
@endsection
