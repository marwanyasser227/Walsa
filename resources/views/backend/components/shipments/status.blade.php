<h4 class="mb-4">اختر عناون الطلبية</h4>
<div class="row ">
    <!-- Card for Address -->
    <div class="col-md-12 my-3   ">
        <div class=" shadow-none border border-1 rounded-1 px-4 py-4" style="background-color:#ffffff00;">
            <form action="{{route('shipment.status' , $shipment->id)}}" method="POST">
                @csrf
                @method('PUT')


                <div class="card-body row align-items-end justify-content-between">
                    <div class="col-md-6">
                        <label for="senderProvince" class="form-label">حالة الشحنة</label>
                        <select class="form-select" id="status" name="status">

                            @foreach ($shipmentSteps as $step => $value)
                            @php
                            $disabled = " ";
                            $selected = " ";
                            $badge = " ";
                            if($step == $shipment->status){
                               $selected = "selected";
                               $disabled = "disabled";
                               $badge ="  - الحالية";
                            }
                        @endphp

                                <option {{$selected}} {{$disabled}}  value="{{$step}}">{{ $value['title']}}{{$badge}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 float-left ">
                       <button type="submit" class=" mt-5 btn btn-danger float-left">تغيير الحالة</button>
                    </div>

                </div>
            </div>

            </form>



    </div>
    
</div>
