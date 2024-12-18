!
@extends('backend.components.layout')
@section('dash')
    <div class="bg-gradient-dark shadow-dark border-radius-lg px-4 py-3">
        <h6 class="text-white text-capitalize ps-3">جدول الشحنات لمستودع {{$hub->city->name}}</h6>
    </div>
    </div>
    <div class="card-body px-0 py-4">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">العميل
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المستقبل
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الحجم
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نوع
                            الشحنة</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">سرعة
                            الشحن</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">التكلفة
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الملبغ
                            المحصل</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الحالة</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">القيام
                            بإجراء</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($hub->city->senders as $sender)
                        @foreach ($sender->shipments as $shipment)
                            @include('backend.components.hubs.show' , ['shipment' => $shipment])
                        @endforeach
                    @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
