<h4 class="mt-5">معلومات المستلم</h4>
<div class="row g-3">
    <p class="mt-4 text-secondary fs-6">المعلومات الأساسية</p>
    <div class="col-md-12">
        <label for="recipient_name" class="form-label">اسم المستلم</label>
        <input type="text" class="form-control" id="recipient_name" name="recipient_name" required>
    </div>

    <div class="col-md-12">
        <label for="sender_name" class="form-label">البريد الإلكتروني للمستلم</label>
        <input type="text" class="form-control" id="recipient_email" name="recipient_email" required>
    </div>
    <div class="col-md-6">
        <label for="recipient_phone" class="form-label">رقم الهاتف</label>
        <input type="text" class="form-control" id="recipient_phone" name="recipient_phone" required>
    </div>
    <div class="col-md-6">
        <label for="recipient_phone" class="form-label">رقم الهاتف الاحتياط</label>
        <input type="text" class="form-control" id="recipient_phone" name="recipient_S_phone" required>
    </div>
    <p class="mt-5 text-secondary fs-6">المعلومات المكان</p>
    <div class="col-md-6">
        <label for="senderProvince" class="form-label">محافظة المستلم</label>
        <select required class="form-select governate" id="governateReciver" name="governateid">
            <option value="" disabled selected>اختر المحافظة</option>

            @foreach ($governates as $governate)
                <option value="{{ $governate->id }}">{{ $governate->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label for="city" required class="form-label">المدينة</label>
        <select required class="form-select city" id="cityReciver" name="r_city_id" disabled>
            <option value="" disabled selected>اختر المدينة</option>
        </select>
    </div>
    <div class="col-md-12">
        <label for="recipient_phone" class="form-label">الشارع</label></label>
        <input type="text" class="form-control" id="recipient_phone" name="recipient_street" required>
    </div>
    <div class="col-md-3">
        <label for="recipient_phone" class="form-label">رقم المبنى</label></label>
        <input type="text" class="form-control" id="recipient_phone" name="recipient_build" required>
    </div>
    <div class="col-md-3">
        <label for="recipient_phone" class="form-label">رقم الطابق</label></label>
        <input type="text" class="form-control" id="recipient_phone" name="recipient_floor" required>
    </div>
    <div class="col-md-3">
        <label for="recipient_phone" class="form-label">رقم الشقة</label></label>
        <input type="text" class="form-control" id="recipient_phone" name="recipient_appartament"
            required>
    </div>
    <div class="col-md-3">
        <label for="recipient_postCode" class="form-label">الرقم البريدي</label></label>
        <input type="text" class="form-control" id="recipient_postCode" name="recipient_postCode"
        required>
    </div>

</div>
