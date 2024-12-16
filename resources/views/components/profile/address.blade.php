<h5 class="mt-4">معلومات العنوان</h5>
<form action="{{ route('user.address.create') }}" method="POST">
    @csrf


    <div class=" row">
        <div class="col-md-12 mb-3">
            <label for="secondPhone" class="form-label">الرقم الثاني</label>
            <input type="tel" class="form-control" name="secondPhone" id="secondPhone" value="">
        </div>
        <div class="mb-3">
            <label for="governate" class="form-label">المحافظة</label>
            <select class="form-select" id="governate" name="governate_id">
                <option value="" disabled selected>اختر المحافظة</option>

                @foreach ($governates as $governate)
                    <option value="{{ $governate->id }}">{{ $governate->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">المدينة</label>
            <select class="form-select" id="city" name="city_id" disabled>
                <option value="" disabled selected>اختر المدينة</option>
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label for="street" class="form-label">الشارع</label>
            <input type="text" class="form-control" name="street" id="street" value="">
        </div>

        <div class="col-md-4">
            <label for="sender_build" class="form-label">رقم المبنى</label></label>
            <input   type="number" class="form-control" id="build" name="bulid_Number" >
        </div>
        <div class="col-md-4">
            <label for="recipient_phone" class="form-label">رقم الطابق</label></label>
            <input type="text" class="form-control" id="floor" name="floor" >
        </div>
        <div class="col-md-4">
            <label for="recipient_phone" class="form-label">رقم الشقة</label></label>
            <input type="text" class="form-control" id="appartement" name="appartement"
                >
        </div>


        <div class="mb-3">
            <label for="postal_code" class="form-label">الرمز البريدي</label>
            <input type="number" name="postCode" class="form-control" id="postal_code" >
        </div>

    </div>



    {{-- <div class="mb-3">
             <label for="country" class="form-label">الدولة</label>
             <input type="text" class="form-control" id="country"
                 value="المملكة العربية السعودية">
         </div> <!-- Futured Feature --> --}}

    <!-- Submit Button -->
    <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
        <a href="{{ route('site.home') }}" class="btn btn-secondary mx-2">إلغاء</a>
    </div>
</form>
<!-- Check if the address is one or more to display it in a table -->
@if (count($user->addresses) > 0)
    <hr>
    <div class="table-responsive">
        <table class="table table-borded my-4">
            <tr>
                <th>#</th>
                <th colspan="4">الشارع</th>
                <th>المحافظة</th>
                <th>المدينة</th>
                <th>الرمز البريدي</th>
                <th>إجراء</th>
            </tr>
            @foreach ($user->addresses as $address)
                <tr>
                    <td>{{ $address->id }}</td>
                    <td colspan="4">{{ $address->street }}</td>
                    <td>{{ $address->city->governate->name }}</td>
                    <td>{{ $address->city->name }}</td>
                    <td>{{ $address->postCode }}</td>
                    <td><a href="{{ route('user.address.edit', $address->id) }}"><i
                                class="bi bi-pen text-warning"></i></a>
                        <a href="{{ route('user.address.delete', $address->id) }}">
                            <i class="bi bi-trash text-danger"></i></a>
                    </td>
                </tr>
            @endforeach
        </table>
@endif
</div>
