    <div class="row gy-4">
        <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
            <div class="card">
              <div class="card-header d-flex justify-content-between p-3 pt-2">
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
                  <i class="material-symbols-rounded opacity-10">weekend</i>
                </div>
                <div class="text-start pt-1">
                  <p class="text-sm mb-0 text-capitalize">أرباح اليوم</p>
                  <h4 class="mb-0">{{$dailyProfits}} ج.م</h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
              </div>
            </div>
          </div>


          <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
            <div class="card">
              <div class="card-header d-flex justify-content-between p-3 pt-2">
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
                  <i class="material-symbols-rounded opacity-10">store</i>
                </div>
                <div class="text-start pt-1">
                  <p class="text-sm mb-0 text-capitalize">الأرباح الكلية</p>
                  <h4 class="mb-0">
                    <span class="text-danger text-sm font-weight-bolder ms-1"></span>
                    {{$totalMoneyCollected}}ج.م
                  </h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
              </div>
            </div>
          </div>


          <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
            <div class="card">
              <div class="card-header d-flex justify-content-between p-3 pt-2">
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
                  <i class="material-symbols-rounded opacity-10">group_add</i>
                </div>
                <div class="text-start pt-1">
                  <p class="text-sm mb-0 text-capitalize">عملاء الشركة</p>
                  <h4 class="mb-0">{{$totalClients}}</h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
            <div class="card">
              <div class="card-header d-flex justify-content-between p-3 pt-2">
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
                  <i class="material-symbols-rounded opacity-10">verified_user</i>
                </div>
                <div class="text-start pt-1">
                  <p class="text-sm mb-0 text-capitalize">عملاء مسجلين</p>
                  <h4 class="mb-0">{{$registerdClients}}</h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
            <div class="card">
              <div class="card-header d-flex justify-content-between p-3 pt-2">
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
                  <i class="material-symbols-rounded opacity-10">no_accounts</i>
                </div>
                <div class="text-start pt-1">
                  <p class="text-sm mb-0 text-capitalize">عملاء غير مسجلين</p>
                  <h4 class="mb-0">{{$totalClients}}</h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="card">
              <div class="card-header d-flex justify-content-between p-3 pt-2">
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
                  <i class="material-symbols-rounded opacity-10">package</i>
                </div>
                <div class="text-start pt-1">
                  <p class="text-sm mb-0 text-capitalize">الشحنات</p>
                  <h4 class="mb-0">{{$shipmentCount}}</h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
              </div>
            </div>

    </div>

    <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="card-header d-flex justify-content-between p-3 pt-2">
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">package_2</i>
            </div>
            <div class="text-start pt-1">
              <p class="text-sm mb-0 text-capitalize">شحنات اليوم</p>
              <h4 class="mb-0">{{$DailyShipmentCount}}</h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
          </div>
        </div>
      </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
          <div class="card-header d-flex justify-content-between p-3 pt-2">
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">handshake</i>
            </div>
            <div class="text-start pt-1">
              <p class="text-sm mb-0 text-capitalize">الشركاء</p>
              <h4 class="mb-0">{{$partners}}</h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
          </div>
        </div>
      </div>
    <div class="row mt-4">
      {{-- <div class="col-lg-4 col-md-6 mt-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h6 class="mb-0 ">مشاهدات الموقع</h6>
            <p class="text-sm ">آخر أداء للحملة</p>
            <div class="pe-2">
              <div class="chart">
                <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
              </div>
            </div>
            <hr class="dark horizontal">
            <div class="d-flex ">
              <i class="material-symbols-rounded text-sm my-auto ms-1">schedule</i>
              <p class="mb-0 text-sm">لحملة أرسلت قبل يومين </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mt-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h6 class="mb-0 ">المبيعات اليومية</h6>
            <p class="text-sm ">(<span class="font-weight-bolder text-success">+15%</span>) زيادة في مبيعات اليوم</p>
            <div class="pe-2">
              <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
              </div>
            </div>
            <hr class="dark horizontal">
            <div class="d-flex ">
              <i class="material-symbols-rounded text-sm my-auto ms-1">schedule</i>
              <p class="mb-0 text-sm">لحملة أرسلت قبل يومين </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mt-4 mb-3">
        <div class="card">
          <div class="card-body">
            <h6 class="mb-0 ">المهام المكتملة</h6>
            <p class="text-sm ">آخر أداء للحملة</p>
            <div class="pe-2">
              <div class="chart">
                <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
              </div>
            </div>
            <hr class="dark horizontal">
            <div class="d-flex ">
              <i class="material-symbols-rounded text-sm my-auto ms-1">schedule</i>
              <p class="mb-0 text-sm">تم تحديثه للتو</p>
            </div>
          </div>
        </div>
      </div> --}}
    </div>
    <div class="row my-4">
      <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
        <div class="card">
          <div class="card-header pb-0">
            <div class="row mb-3">
              <div class="col-6">
                <h6>الشحنات</h6>

              </div>

            </div>
          </div>
          <div class="card-body p-0 pb-2">
            <div class="table-responsive">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">رقم التتبع</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">التكلفة</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الحالة</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach ($shipments as $shipment)
                 @php
                 //! Make a code to change status numbers to strings notes
                 $status = 0;
                 $style = '';
                 $text = '#000';
                 switch ($shipment->status) {
                     case 0:
                         $status = "تم الاستلام";
                         $style = "#4de170ad";
                         $text = '#000';
                         break;

                     case 1:
                         $status = "جاري التجهيز";
                         $style = "#4de170ad";

                         break;
                     case 2:
                         $status = "قيد التوصيل";
                         $style = "#e7914f";

                         break;
                     case 3:
                         $status = "وصل لوجهته";
                         $style = "#4de170ad";

                         break;
                     case 4:
                         $status = "قيد التأجيل";
                         $style = " #0D6EFD";
                         $text = '#fff';

                         break;
                     case 5:
                         $status = "تم الإلغاء";
                         $style = "#e74f4f";
                         $text = "#fff";

                         break;
                     case 6:
                         $status = "تم الاستعادة";
                         $style = "#4de170ad";
                         break;


                     default:
                         $status = 'غير معروفة';
                         $style = "#333";
                         $text = "#fff";
                 }
             @endphp
                 <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        {{$shipment->id}}
                      </div>
                    </td>
                    <td>
                        <p class="text-sm text-end">

                            {{$shipment->trackNumber}}
                        </p>

                    </td>
                    <td class="align-middle text-center text-sm">
                      <p class="text-xs font-weight-bold mx-auto align-middle text-center"> {{$shipment->shipment_costs}}  ج.م</p>
                    </td>
                   <td>
                        <p class="text-sm text-center">

                            {{$status}}
                        </p>

                    </td>
                  </tr>

                 @endforeach



                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card h-100">
          <div class="card-header pb-0">
            <h6>نظرة عامة على الأنشطة</h6>

          </div>
          <div class="card-body p-3">
            <div class="timeline timeline-one-side">
             @foreach ($logs as $log)
             <div class="timeline-block mb-3">
                <span class="timeline-step">
                  <i class="material-symbols-rounded text-success text-gradient">notifications</i>
                </span>
                <div class="timeline-content">
                  <h6 class="text-dark text-sm font-weight-bold mb-0">{{$log->action}}</h6>
                  <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{$log->created_at->diffForHumans()}}</p>
                </div>
              </div>
             @endforeach


            </div>
          </div>
        </div>
      </div>
    </div> --}}
    {{-- <footer class="footer py-4  ">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="copyright text-center text-sm text-muted text-lg-end">
              © <script>
                document.write(new Date().getFullYear())
              </script>,
              made with <i class="fa fa-heart"></i> by
              <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
              for a better web.
            </div>
          </div>
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer> --}}
