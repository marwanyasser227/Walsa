@extends('backend.components.layout')

@section('dash')
    <div class="container my-5">

    <div class="bg-gradient-dark shadow-dark border-radius-lg px-4 py-3">
        <h6 class="text-white text-capitalize ps-3">جدول الأنشطة </h6>

    </div>

    <div class="card-body px-0 py-4">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المستخدم
                            </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الإجراء
                            </th>

                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الرتبة
                            </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">التفاصيل
                            </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">حذف الإشعار
                            </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr>

                            <td>
                                <p class="text-start">
                                    {{ $log->id }}

                                </p>
                            </td>

                            @if ($log->user !== null)
                            <td>
                                <p class="text-center">
                                    {{ $log->user->name }}

                                </p>
                            </td>

                            @elseif($log->sender != null)
                            <td>
                                <p class="text-center">
                                    {{ $log->sender->name }}

                                </p>
                            </td>
                            @else
                            <td>
                                <p class="text-center">
                                    يعذر العثور على بيانات المستخدم

                                </p>
                            </td>
                            @endif

                            <td>
                                <p class="text-center">
                                    {{ $log->action }}

                                </p>
                            </td>
                            <td>
                                <p class="text-center">
                                    {{ $log->model }}

                                </p>
                            </td>
                            <td>
                                <p class="text-center">
                                    <pre class="text-center">{{$log->details != null ? print_r($log->details, true) : "لا يوجد تفاصيل" }}</pre>
                                </p>
                            </td>

                            <td class="row justify-content-center align-items-center">






                                    <div class="col-md-2">
                                        <form action="{{ route('admin.delete.logs', $log->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class=" p-2 rounded-0 btn btn-md btn-danger"
                                                data-toggle="tooltip" data-original-title="Edit user"> <i
                                                    class="material-symbols-rounded opacity-10">delete</i></button>
                                        </form>

                                    </div>



                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
@endsection
