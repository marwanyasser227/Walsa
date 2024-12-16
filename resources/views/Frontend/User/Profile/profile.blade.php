@extends('components.appLayout')

@section('content')
    <div class=" container-fluid my-5">
        <div class=" main-container row justify-content-center border border-1 rounded-1 py-5 px-4">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-success">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">حسابي </li>
                </ol>
            </nav>
            <!-- End Breadcrumb -->
            <!-- Profile Content -->
            <div class="col-12 col-md-10 col-lg-8">
                <div class="row justify-content-between">
                    <!-- Profile Image -->
                    @include('components.profile.image')
                    <!-- Profile Image -->

                    <!-- User Info -->
                    @include('components.profile.informations')

                    <!-- User Info -->

                    <hr>

                    <!-- Address Information -->
                    @include('components.profile.address')

                    <!-- Address Information -->


            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
