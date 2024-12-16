@extends('components.appLayout')

@section('content')
    <div class=" container-fluid my-5">
        <div class=" main-container row justify-content-center border border-1 rounded-1 py-5 px-4">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('site.home')}}" class="text-decoration-none text-success">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="{{route('user.profile')}}" class="text-decoration-none text-success">حسابي</a></li>
                    <li class="breadcrumb-item active" aria-current="page">عنوان {{$address->id}} </li>
                </ol>
            </nav>
            <!-- Address Information -->
            <h5 class="mt-4">معلومات العنوان</h5>
            <form action="{{ route('user.address.update', $address->id) }}" method="POST">
                @csrf

                @method('PUT')
                <div class=" row">
                    <div class="col-md-12 mb-3">
                        <label for="secondPhone" class="form-label">الرقم الثاني</label>
                        <input type="tel" class="form-control" name="secondPhone" id="secondPhone" value="{{$address->secondPhone}}">
                    </div>

                <div class="mb-3">
                    <label for="governate" class="form-label">المحافظة</label>
                    <select class="form-select" required id="governate" name="governate_id">
                        <option value="" disabled>اختر المحافظة</option>
                        <option value="{{ $address->city->governate->id }}" selected>{{ $address->city->governate->name }}
                        </option>

                        @foreach ($governates as $governate)
                            @if ($governate->name == $address->city->governate->name)
                                @continue
                            @endif
                            <option value="{{ $governate->id }}">{{ $governate->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="city" required class="form-label">المدينة</label>
                    <select class="form-select" id="city" name="city_id" disabled>
                        <option value="" disabled selected>اختر المدينة</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="street" class="form-label">الشارع</label>
                    <input type="text" class="form-control" name="street" id="street" value="{{ $address->street }}">
                </div>

                <div class="col-md-4">
                    <label for="sender_build" class="form-label">رقم المبنى</label></label>
                    <input   type="number" class="form-control" id="build" value="{{$address->build_Number}}" name="bulid_Number" >
                </div>
                <div class="col-md-4">
                    <label for="recipient_phone" class="form-label">رقم الطابق</label></label>
                    <input type="text" class="form-control" id="floor" value="{{$address->floor}}" name="floor" >
                </div>
                <div class="col-md-4">
                    <label for="recipient_phone" class="form-label">رقم الشقة</label></label>
                    <input type="text" class="form-control" id="appartement" value="{{$address->appartement}}" name="appartement"
                        >
                </div>


                <div class="mb-3">
                    <label for="postal_code" class="form-label">الرمز البريدي</label>
                    <input type="number" name="postCode" class="form-control" id="postal_code" value="{{$address->postCode}}" >
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input checkbox-address" {{ $address->isMain == 1 ? 'checked' : '' }}
                        type="checkbox" value="1" id="flexCheckDefault" name = 'isMain'>
                    <label class="form-check-label" for="flexCheckDefault">
                        العنوان الأساسي؟
                    </label>
                </div>
                {{-- <div class="mb-3">
                                 <label for="country" class="form-label">الدولة</label>
                                 <input type="text" class="form-control" id="country"
                                     value="المملكة العربية السعودية">
                             </div> <!-- Futured Feature --> --}}

                <!-- Submit Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">إنشاء عنوان</button>
                    <a href="{{ route('site.home') }}" class="btn btn-secondary mx-2">إلغاء</a>
                </div>
            </form>
            <!-- Check if the address is one or more to display it in a table -->
        </div>
    </div>
@endsection
