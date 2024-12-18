<!-- Header Component -->
<header class="logistics-header">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('site.home') }}">وصلة</a>

            <!-- Toggler for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nav Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('site.home') }}">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shipment.create') }}">إنشاء شحنة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('site.about') }}">من نحن</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('site.contact') }}">تواصل معنا</a>
                    </li>
                </ul>

                <!-- Case User Has no Account -->
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-secondary ms-3">تسجيل الدخول</a>
                    </li>
                @endguest

                <!-- Case User is Authenticated -->
                @auth
                    <!-- Profile and Notifications -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Profile Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="profileDropdown" role="button"
                                data-bs-toggle="dropdown">
                                <span>مرحبًا، {{ Auth::user()->name }}</span>
                                <img src="{{ Auth::user()->profileImage == null ? asset('assets/profileimages/avatar.jpg') : asset(Auth::user()->profileImage) }}"
                                    width="30" height="30" alt="Profile" class="rounded-circle"
                                    style="height: 30px; object-fit:cover" />
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('user.profile') }}">حسابي</a></li>
                                <li><a class="dropdown-item" href="{{ route('shipment.list') }}">طلباتي</a></li>
                                {{-- <li><a class="dropdown-item" href="{{ route('shipment.clients') }}">عملائي</a></li> --}}
                                <li><a class="dropdown-item" href="{{ route('site.branchs') }}">فروعنا</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}">تسجيل الخروج</a></li>
                            </ul>
                        </li>

                        <!-- Notifications Dropdown -->
                           <!-- Notifications Dropdown -->
                           <li class="nav-item dropdown position-relative">
                            <a class="nav-link dropdown-toggle" id="notificationDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-bell"></i>
                                @if(Auth::user()->unreadNotifications->count())
                                    <span class="badge bg-danger rounded-circle" style="font-size: 10px; position: absolute; top: -5px; right: -5px;">
                                        {{ Auth::user()->unreadNotifications->count() }}
                                    </span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="dropdown-header">الإشعارات</li>
                                @forelse(Auth::user()->unreadNotifications as $notification)
                                    <li><a class="dropdown-item" href="{{route('user.notifications')}}">{{ $notification->data['message'] }}</a></li>
                                @empty
                                    <li><a class="dropdown-item" href="{{route('user.notifications')}}">لا توجد إشعارات جديدة</a></li>
                                @endforelse
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-center" href="{{ route('user.notifications') }}">مشاهدة الإشعارات</a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                    @endauth
                    <!-- Track Order Button -->
                    <li class="nav-item ">
                        <a href="{{ route('shipment.track') }}" class=" nav-track btn btn-primary ms-3">تتبع الطلب</a>
                    </li>
            </div>
        </div>
    </nav>
</header>
