<footer class="footer">
    <div class="container">
        <div class="row ">
            <!-- Footer Logo & Company Info -->
            <div class="col-md-4">
                <a href="#" class="footer-logo">
                    <a class="navbar-brand fs-1 text-white" href="#">وصلة</a>
                </a>
                <p class="footer-description">
                    نحن شركة شحن رائدة متخصصة في تقديم حلول لوجستية متكاملة وموثوقة. نسعى لتوفير أفضل تجربة شحن لعملائنا
                    من خلال خدماتنا السريعة والمرنة التي تلبي احتياجات الأفراد والشركات.

                </p>
                <!-- Social Media Icons -->
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
            <div class="col-md-8 row justify-content-end">
                <!-- Quick Links -->
                <div class="col-lg-3 col-md-3">
                    <h5>روابط تهمك</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('site.home') }}">الرئيسية</a></li>
                        <li><a href="{{ route('site.branchs') }}">فروعنا</a></li>

                        <li><a href="{{ route('site.about') }}">عنا</a></li>
                        <li><a href="{{ route('site.contact') }}">تواصل معنا</a></li>
                    </ul>
                </div>
                <!-- Profile Links -->
                <div class="col-lg-3 col-md-4">
                    <h5>إدارة الحساب الشخصي</h5>
                    <!-- Case User is Auth -->

                    @auth
                        <ul class="footer-links">
                            <li><a href="{{ route('user.profile') }}">الملف الشخصي</a></li>
                            <li><a href="{{ route('shipment.list') }}">طلباتي</a></li>
                            <li><a href="{{ route('shipment.track') }}">تتبع الطلبات</a></li>

                            {{-- <li><a href="#">قائمة العملاء</a></li> --}}
                            <li><a href="{{ route('logout') }}">تسجيل الخروج</a></li>
                        </ul>
                    @endauth
                    <!-- Case User Has no Account -->
                    @guest
                        <ul class="footer-links">

                            <li style="list-style: none" class="mx-auto">
                                <a href="{{ route('login') }}" class="btn btn-secondary">تسجيل الدخول</a>
                            </li>
                        </ul>

                    @endguest
                </div>

                <!-- Contact Info -->
                <div class="col-lg-4 col-md-5">
                    <h5>تواصل معنا</h5>
                    <ul class="footer-contact">
                        <li><i class="bi bi-telephone"></i>+201024392440</li>
                        <li><i class="bi bi-envelope"></i> support@Yasla.com</li>
                        <li><i class="bi bi-geo-alt"></i> شارع الصفا والمروة , المنصورة , مصر</li>
                    </ul>
                </div>
            </div>
        </div>



        <!-- Footer Bottom Text -->
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> جميع الحقوق محفوظة لشركة وصلة | بٌرمج وصمم بواسطة مروان ياسر</p>
        </div>
    </div>
</footer>
