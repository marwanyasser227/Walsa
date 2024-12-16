<div class="col-12 mb-4 alert alert-success py-4">
    <h3 class="text-success">تفاصيل الشحنة</h3>
    <p><strong>رقم التتبع:</strong> {{ $shipment->trackNumber }}</p>
    <p><strong>مركز الالتقاط:</strong> {{$shipment->sender->city->name}}</p>
    <p><strong>مركز التسليم:</strong> {{ $shipment->reciver->city->name }}</p>
    <p><strong>اسم العميل:</strong> {{ $shipment->reciver->name }}</p>
    <p><strong>التاريخ:</strong> {{ $shipment->created_at }}</p>
    <p><strong>الوجهة:</strong> {{ $shipment->reciver->city->governate->name }}</p>
    <p><strong>الوزن:</strong> {{ $shipment->itemSize }}كغ</p>
    <p><strong>النوع:</strong> {{ $shipment->itemType }}</p>
    <p><strong>التكلفة:</strong> {{$shipment->shipment_costs }} ج.م</p>
</div>
