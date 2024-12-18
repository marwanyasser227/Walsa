<tr>
    <td>
        <div class="d-flex px-2 py-1">
            <div>
                {{-- <img src="{{asset('assets/avatar.jpg')}}" class="mx-3 avatar avatar-sm me-3 border-radius-lg" alt="user1"> --}}
            </div>

            <div class="d-flex flex-column justify-content-center">

                <h6 class="mb-0 text-sm">شحنة رقم {{ $shipment->id }}</h6>
                <p class="text-xs text-secondary mb-0">{{ $shipment->trackNumber }}</p>
            </div>
        </div>
    </td>
    <td class="align-middle text-center text-sm">
        <p class="text-xs text-secondary mb-0">{{ $shipment->sender->name }}</p>
    </td>
    <td class="align-middle text-center text-sm">
        <p class="text-xs text-secondary mb-0">{{ $shipment->reciver->name }}</p>
    </td>
    <td class="align-middle text-center text-sm">
        <p class="text-xs text-secondary mb-0">{{ $shipment->itemSize }} كغ</p>
    </td>
    <td class="align-middle text-center text-sm">
        <p class="text-xs text-secondary mb-0">{{ $shipment->itemType }} </p>
    </td>
    <td class="align-middle text-center text-sm">
        <p class="text-xs text-secondary mb-0">{{ $shipment->shipmentType }} </p>
    </td>
    <td class="align-middle text-center text-sm">
        <p class="text-xs text-secondary mb-0">{{ $shipment->shipment_costs }} ج.م </p>
    </td>
    <td class="align-middle text-center text-sm">
        <p class="text-xs text-secondary mb-0">{{ $shipment->collectedPrice }} ج.م </p>
    </td>
    <td>
        @foreach ($shipmentSteps as $status => $step)
            @if ($shipment->status == $status)
                <p
                    class="text-xs font-weight-bold mb-0 badge badge-sm bg-gradient-{{ $step['color'] }}">
                    {{ $step['title'] }}</p>
            @endif
        @endforeach
    </td>
    <td class="row justify-content-center align-items-center">

        <div class="col-md-2">
            <a href="{{ route('shipment.show', $shipment->id) }}"
                class="mt-2 p-2 rounded-0 btn btn-md btn-success" data-toggle="tooltip"
                data-original-title="Edit user">
                <i class="material-symbols-rounded opacity-10">visibility</i>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('shipment.edit', $shipment->id) }}"
                class="mt-2 p-2 rounded-0 btn btn-md btn-warning" data-toggle="tooltip"
                data-original-title="Edit user">
                <i class="material-symbols-rounded opacity-10">edit</i>
            </a>

        </div>
        <div class="col-md-2">
            <form action="{{ route('shipment.delete', $shipment->id) }}" method="post">
                @csrf
                @method('DELETE')

                <button type="submit" class="mt-4 p-2 rounded-0 btn btn-md btn-danger"
                    data-toggle="tooltip" data-original-title="Edit user"> <i
                        class="material-symbols-rounded opacity-10">delete</i></button>
            </form>

        </div>
    </td>
</tr>
