@extends('components.appLayout')

@section('content')
    <div class="container my-5 ">
        <h4>الاشعارات</h4>

        @php
            $none = '';
            if (count($notifications) == 0) {
                $none = 'd-none';
            }
        @endphp

        <div class="mb-3 {{ $none }}">
            <form action="{{ route('notifications.readAll') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">جعل الجميع مقروء</button>
            </form>
        </div>

        <ul class="list-group">
            @forelse($notifications as $notification)
                <li class="list-group-item my-3 p-3 {{ $notification->read_at ? 'bg-light' : '' }}">
                    {{ $notification->data['message'] }}
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>

                    @if (!$notification->read_at)
                        <form action="{{ route('notifications.read', $notification->id) }}" method="POST"
                            class="d-inline-block ms-2">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-secondary">قراءة الجميع</button>
                        </form>
                    @endif
                </li>

            @empty
                <div class="">

                    <div class="vh-50 rounded-2 py-5" style="background-color: #56c8a426;   padding:26px;">
                        <h3 class="text-center ">لا توجد إشعارات 😒</h3>

                    </div>
                </div>
            @endforelse
        </ul>
    </div>
@endsection
