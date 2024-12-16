<div class="col-12 mb-4 alert alert-dark py-4">
    <h3 class="text-white my-3">تفاصيل الشحنة</h3>
    <p style ='color:#ffffffe1'><strong>رقم التتبع:</strong> {{ $shipment->trackNumber }}</p>
    <p style ='color:#ffffffe1'><strong>مركز الالتقاط:</strong> {{$shipment->sender->city->name}}</p>
    <p style ='color:#ffffffe1'><strong>مركز التسليم:</strong> {{ $shipment->reciver->city->name }}</p>
    <p style ='color:#ffffffe1'><strong>اسم العميل:</strong> {{ $shipment->reciver->name }}</p>
    <p style ='color:#ffffffe1'><strong>التاريخ:</strong> {{ $shipment->created_at }}</p>
    <p style ='color:#ffffffe1'><strong>الوجهة:</strong> {{ $shipment->reciver->city->governate->name }}</p>
    <p style ='color:#ffffffe1'><strong>الوزن:</strong> {{ $shipment->itemSize }}كغ</p>
    <p style ='color:#ffffffe1'><strong>النوع:</strong> {{ $shipment->itemType }}</p>
    <p style ='color:#ffffffe1'><strong>التكلفة:</strong> {{$shipment->shipment_costs }} ج.م</p>
</div>
