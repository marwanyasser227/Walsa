<div class="col-md-4 text-center mb-3">
    <form action="{{ route('user.updateProfileImage') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <img id="profileImage"
            src="{{ Auth::user()->profileImage ? asset(Auth::user()->profileImage) : asset('assets/profileimages/avatar.jpg') }}"
            width="150" height="150" alt="Profile Image" class="rounded-circle img-fluid mb-3"
            style="max-width: 150px; height:150px; object-fit:cover; cursor: pointer;">
        <input type="file" id="imageUpload" name="profile_image" accept="image/*"
            style="display: none;">
        <div class="mb-12">
            <button type="submit" class="btn btn-secondary btn-sm">تغيير الصورة</button>
        </div>
    </form>
</div>
