 <!-- Page Title -->

 <h4 class="my-4 text-success">الشحنات الحالية 🚚</h4>

 <!-- Shipment List -->
 <div class="row gap-4">
     @forelse ($shipments as $shipment)
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
         <!-- Shipment Card -->
         <div class="col-md-12">
             <div class="card border-1 shadow-sm rounded-3 ">
                 <div class="card-body">
                     <!-- Shipment Status -->
                     <div class="mb-3 shipment-container">
                        <div class="my-3">
                            <span class="status-badge p-1  " style="background-color:{{$style}}; color:{{$text}}">{{$status}}</span>

                        </div>
                         <h5 class="mb-0 text-muted">معرف الشحنة: {{$shipment->trackNumber}} <span
                                 class="text-dark"></span></h5>
                     </div>

                     <!-- Shipment Details -->
                     <div class="row align-items-center">
                         <div class="col-md-8 col-sm-12">
                             <p class="mb-0 text-muted">تاريخ الشحنة: <span
                                     class="text-dark">{{ $shipment->created_at }}</span></p>
                             <p class="mb-0 text-muted">وجهة الشحنة: <span
                                     class="text-dark">{{ $shipment->reciver->city->governate->name }}</span></p>
                         </div>
                         <div class="col-md-4 col-sm-12 text-end">
                             <a href="{{ route('shipment.details' , $shipment->id) }}"
                                 class="track-btn btn btn-outline-success rounded-pill px-4 py-2">
                                 تتبع الشحنة <i class="bi bi-arrow-left-short"></i>
                             </a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- End Shipment Card -->
         @empty
             <div class="text-center mt-4">
                 <h3 class="text-center">لا يوجد شحنات 😢</h2>

                     <a href="{{ route('shipment.create') }}" class="btn btn-secondary mx-2">إنشاء شحنة</a>
             </div>
         @endforelse

     </div>
