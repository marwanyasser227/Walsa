<h4 class="my-4">تفاصيل الطرد</h4>
<div class="row g-3">
    <div class="col-md-4">
        <label for="package_weight" class="form-label">وزن الطرد (كجم)</label>
        <input type="number" step="0.01" class="form-control" id="package_weight" name="package_weight"
            required>
    </div>
    <div class="col-md-4">
        <label for="package_type" class="form-label">نوع الطرد</label>
        <select class="form-select" id="package_type" name="package_type" required>
            <option value="document">وثائق</option>
            <option value="parcel">طرد</option>
            <option value="fragile">قابل للكسر</option>
            <option value="other">أخرى</option>
        </select>
    </div>
    <div class="col-md-4">
        <label for="shipping_option" class="form-label">طريقة الشحن</label>
        <select class="form-select" id="shipping_option" name="shipping_option" required>
            <option value="standard">عادي</option>
            <option value="express">سريع</option>
        </select>
    </div>



<div class="form-check mb-3  col-md-6">
    <input class=" ms-1 form-check-input checkbox-address" type="checkbox" value="1"
        id="show-input" name = 'collectMoney'>
    <label class="form-check-label" for="flexCheckDefault">
        تحصيل أموال من العميل
    </label>
</div>


<div class="col-md-6 my-5">
    <label for="package_weight" class="form-label">المبلغ (جنية مصري)</label>
    <input type="number" step="0.01" class="form-control" id="collectedPrice" name="collectedPrice"
        required>
</div>

</div>



<!-- Submit Button -->
<div class="text-end mt-4">
    <button type="submit" class="btn btn-secondary btn-lg">إنشاء الشحنة</button>
</div>
