<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-end me-2 rotate-caret bg-white my-2"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute start-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
            target="_blank">

            <span class="me-1 text-sm text-dark" style="font-weight: 900">وصلة</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse px-0 w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <!-- Existing Items -->
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('dashboard.main') }}">
                    <i class="material-symbols-rounded opacity-10">dashboard</i>
                    <span class="nav-link-text me-1">لوحة القيادة</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('dashboard.shipments') }}">
                    <i class="material-symbols-rounded opacity-10">package_2</i>
                    <span class="nav-link-text me-1">الشحنات</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('dashboard.users') }}">
                    <i class="material-symbols-rounded opacity-10">account_circle</i>
                    <span class="nav-link-text me-1">العملاء</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('dashboard.testimonails') }}">
                    <i class="material-symbols-rounded opacity-10">reviews</i>
                    <span class="nav-link-text me-1">التوصيات</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('partners.index') }}">
                    <i class="material-symbols-rounded opacity-10">handshake</i>
                    <span class="nav-link-text me-1">الشركاء</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link text-dark" href="#locationsSubMenu" data-bs-toggle="collapse" aria-expanded="false">
                    <i class="material-symbols-rounded opacity-10">location_on</i>
                    <span class="nav-link-text me-1">المواقع</span>
                </a>
                <ul class="collapse list-unstyled" id="locationsSubMenu">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('cities.index') }}">
                            <i class="material-symbols-rounded opacity-10">apartment</i>
                            <span class="nav-link-text me-1">المدن</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('governorates.index') }}">
                            <i class="material-symbols-rounded opacity-10">flag</i>
                            <span class="nav-link-text me-1">المحافظات</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('areas.index') }}">
                            <i class="material-symbols-rounded opacity-10">map</i>
                            <span class="nav-link-text me-1">المناطق</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('contact.index') }}">
                    <i class="material-symbols-rounded opacity-10">notes</i>
                    <span class="nav-link-text me-1">الرسائل</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('admin.activity-logs') }}">
                    <i class="material-symbols-rounded opacity-10">mark_unread_chat_alt</i>
                    <span class="nav-link-text me-1">الأنشطة</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('user.notifications') }}">
                    <i class="material-symbols-rounded opacity-10">notifications</i>
                    <span class="nav-link-text me-1">الإشعارات</span>
                </a>
            </li>


        </ul>

    </div>

</aside>
