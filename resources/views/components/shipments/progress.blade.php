<div class="col-12 my-5 border border-1 rounded-1 p-4">
    <h4 class="text-success mb-3 ">حالة الشحنة</h4>
    <div class="progress-container ">
        <!-- Progress Line -->
        @php
            // Filter steps based on the current status
            if ($shipment->status == 4) {
                $shipmentSteps = [
                    0 => ['title' => 'تم استلام الطلب', 'icon' => 'bi-check-circle', 'color' => 'green'],

                    4 => ['title' => 'تم تأجيل الشحنة', 'icon' => 'bi-hourglass-split', 'color' => 'orange'],
                ];

            } elseif ($shipment->status == 5) {
                $shipmentSteps = [
                    0 => ['title' => 'تم استلام الطلب', 'icon' => 'bi-check-circle', 'color' => 'green'],

                    5 => ['title' => 'تمت إلغاء الشحنة', 'icon' => 'bi-arrow-clockwise', 'color' => 'orange']
                ];
            }elseif($shipment->status == 6){
                $shipmentSteps = [
                    0 => ['title' => 'تم استلام الطلب', 'icon' => 'bi-check-circle', 'color' => 'green'],

                    6 => ['title' => 'تمت استعادة الشحنة', 'icon' => 'bi-arrow-clockwise', 'color' => ''],
                    ];
            }elseif($shipment->status > 6){
                $shipmentSteps = [
                    0 => ['title' => 'تم استلام الطلب', 'icon' => 'bi-check-circle', 'color' => 'green'],

                    7 => ['title' => 'غير معروفة الحالة', 'icon' => 'bi-eye-slash', 'color' => 'grey'],
                    ];
            }

        @endphp
        <div class="progress-line">
            <div class="progress-line-active"
                style="width: {{ $shipment->status <= 3 ? ($shipment->status / 3) * 100 : 100 }}%; background-color: {{ $shipment->status <= 3 ? 'green' : ($shipment->status == 4 ? 'orange' : ($shipment->status == 5 ? 'red' : 'blue')) }};">
            </div>
        </div>

        <!-- Steps -->

        @foreach ($shipmentSteps as $status => $step)
            <div class="progress-step {{ $shipment->status == $status ? 'active' : '' }}">
                <span class="icon bi {{ $step['icon'] }}"
                    style="color: {{ $shipment->status == $status ? $step['color'] : '#ddd' }};"></span>
                <span class="step-title">{{ $step['title'] }}</span>
            </div>
        @endforeach
    </div>


