<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-symbols-rounded py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-end">
          <h5 class="mt-3 mb-0">لوحة تحكم وصلة</h5>
        </div>
        <div class="float-start mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-symbols-rounded">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">

        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">نوع الشريط الجانبي</h6>
          <p class="text-sm">اختر من ثلاثة أنواع مختلفة.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2" data-class="bg-gradient-dark" onclick="sidebarType(this)">الداكن</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">الشفاف</button>
          <button class="btn bg-gradient-dark px-3 mb-2  active me-2" data-class="bg-white" onclick="sidebarType(this)">الأبيض</button>
        </div>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">الشريط الثابت</h6>
          <div class="form-check form-switch me-auto my-auto">
            <input class="form-check-input mt-1 float-end me-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">فاتح / داكن</h6>
          <div class="form-check form-switch me-auto my-auto">
            <input class="form-check-input mt-1 float-end me-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        
        </div>
      </div>
    </div>
  </div>
