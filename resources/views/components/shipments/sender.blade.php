@if (Auth::user() && count(Auth::user()->addresses) >= 1)

    <h4 class="mb-4">اختر عناون الطلبية</h4>
    <div class="row ">
        <!-- Card for Address -->
        <div class="col-md-12 my-3   ">
            <div class=" shadow-none border border-1 rounded-1 px-4 py-4" style="background-color:#ffffff00;">

                <div class="card-body">
                    @foreach (Auth::user()->addresses as $address)
                        <div class="form-check align-items-start my-3">
                            <input class="form-check-input checkbox-address " type="radio"
                                name="selected_address" id="address1" value="{{ $address->id }}">
                            <label class="form-check-label  " for="address1">
                                <strong>{{ $address->street }}</strong>
                                <p class="text-secondary">
                                    {{ $address->user->phone }} | {{ $address->city->name }} |
                                    {{ $address->city->governate->name }} </p>

                            </label>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@else
    <h4 class="mb-3">معلومات المرسل</h4>
    <div class="row g-3">
        <div class="col-md-12">
            <label for="sender_name" class="form-label">اسم المرسل</label>
            <input type="text" class="form-control" id="sender_name" name="sender_name">
        </div>
        <div class="col-md-12">
            <label for="sender_name" class="form-label">البريد الإلكتروني للمرسل</label>
            <input type="text" class="form-control" id="sender_email" name="sender_email" required>
        </div>
        <div class="col-md-6">
            <label for="sender_phone" class="form-label">رقم الهاتف</label>
            <input type="text" class="form-control" id="sender_phone" name="sender_phone" required>
        </div>

        <div class="col-md-6">
            <label for="sender_phone" class="form-label"> رقم الهاتف الاحتياط</label>
            <input type="text" class="form-control" id="sender_phone" name="sender_S_phone" required>
        </div>



        <p class="mt-5 text-secondary fs-6">المعلومات المكان</p>
        <div class="col-md-6">
            <label for="senderProvince" class="form-label">محافظة المستلم</label>
            <select class="form-select" id="governate" name="governate_id">
                <option value="" disabled selected>اختر المحافظة</option>

                @foreach ($governates as $governate)
                    <option value="{{ $governate->id }}">{{ $governate->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="city" required class="form-label">المدينة</label>
            <select class="form-select" id="city" name="city_id" disabled>
                <option value="" disabled selected>اختر المدينة</option>
            </select>
        </div>
        <div class="col-md-12">
            <label for="recipient_phone" class="form-label">الشارع</label></label>
            <input type="text" class="form-control" id="recipient_street" name="sender_street" required>
        </div>
        <div class="col-md-3">
            <label for="sender_build" class="form-label">رقم المبنى</label></label>
            <input type="number" class="form-control" id="sender_build" name="sender_build" required>
        </div>
        <div class="col-md-3">
            <label for="recipient_phone" class="form-label">رقم الطابق</label></label>
            <input type="text" class="form-control" id="recipient_phone" name="sender_floor" required>
        </div>
        <div class="col-md-3">
            <label for="recipient_phone" class="form-label">رقم الشقة</label></label>
            <input type="text" class="form-control" id="recipient_phone" name="sender_appartament"
                required>
        </div>
        <div class="col-md-3">
            <label for="sender_PostCode" class="form-label">الرقم البريدي</label></label>
            <input type="text" class="form-control" id="sender_PostCode" name="sender_PostCode"
                required>
        </div>
        <!-- A code to make possible register via the form of shipment creation -->
        @guest
            <div class="col-md-12">
                <p class="mt-5 text-secondary fs-6 alert  " style="background-color:#5dd2ce3e">رائع أنت على بعد
                    خطوات من امتلاك حساب في الموقع بدون مجهود 😎👌</p>

            </div>

            <div class="form-check mb-3  col-md-4">
                <input class=" ms-1 form-check-input checkbox-address" type="checkbox" value="1"
                    id="flexCheckDefault" name = 'createAccount'>
                <label class="form-check-label" for="flexCheckDefault">
                    إنشاء حساب جديد في الموقع
                </label>
            </div>
        @endguest

    </div>
@endif
