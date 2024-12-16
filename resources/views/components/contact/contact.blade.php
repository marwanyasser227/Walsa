<div class="contact-form-wrapper bg-light shadow rounded-3 p-5">
    <h3 class="mb-4 text-center">تواصل معنا🎧</h3>
    <p class="text-muted mb-4 text-center">لديك سؤال؟ املأ النموذج أدناه وسنكون على تواصل معك قريبًا!</p>
    <form action="{{route('site.contact.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">الاسم الكامل</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="أدخل اسمك">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="أدخل بريدك الإلكتروني">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">الهااتف</label>
            <input type="tel" name="phone" class="form-control" id="phone" placeholder="أدخل رقم هاتفك">
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">رسالتك</label>
            <textarea class="form-control"  name="message" rows="4" placeholder="أدخل رسالتك هنا"></textarea>
        </div>
        <button type="submit" class="btn btn-secondary px-4 py-2 w-100">إرسال</button>
    </form>
</div>
