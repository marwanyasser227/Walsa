<div class="col-md-8 col-sm-12">
    <form action="{{ route('user.profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">الاسم الكامل</label>
            <input type="text" class="form-control" name="name" id="name"
                value="{{ $user->name }}">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">المسمى الوظيفي</label>
            <input type="text" class="form-control" name="jobTitle" id="title" value="مبرمج ويب">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" name ='email'class="form-control" id="email"
                value="{{ $user->email }}">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">رقم الهاتف</label>
            <input type="tel" name = 'phone' class="form-control" id="phone"
                value="{{ $user->phone }}">
        </div>
        <!-- Submit Button -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            <a href="{{ route('site.home') }}" class="btn btn-secondary mx-2">إلغاء</a>
        </div>
    </form>
