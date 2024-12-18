
@extends('backend.components.layout')
@section('dash')

    <div class="bg-gradient-dark shadow-dark border-radius-lg px-4 py-3">
        <h6 class="text-white text-capitalize ps-3">جدول التوصيات</h6>

    </div>
    <div class="card-body px-0 py-4">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المسمى
                            الوظيفي</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">القيام
                            بإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testimonials as $testimonail)
                        <tr>

                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                        <img src="{{$testimonail->image == null ? asset('assets/profileimages/avatar.jpg') : asset($testimonail->image) }}"
                                            class="mx-3 avatar avatar-sm me-3 border-radius-lg" style="object-fit: cover" alt="user1">
                                    </div>

                                    <div class="d-flex flex-column justify-content-center">

                                        <h6 class="mb-0 text-sm">{{ $testimonail->name }}</h6>
                                        <span class="mb-0 text-xs text-muted">معرف : {{ $testimonail->id }}</span>

                                    </div>
                                </div>
                            </td>

                            <td>
                                <p class="text-center">
                                    {{ $testimonail->jobTitle }}

                                </p>
                            </td>




                            <td class="row justify-content-center align-items-center">

                                <div class="col-md-2">
                                    <a href="{{ route('testimonail.show', $testimonail->id) }}"
                                        class="0 p-2 rounded-0 btn btn-md btn-success" data-toggle="tooltip"
                                        data-original-title="Edit user">
                                        <i class="material-symbols-rounded opacity-10">visibility</i>
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('testimonail.edit', $testimonail->id) }}"
                                        class=" p-2 rounded-0 btn btn-md btn-warning" data-toggle="tooltip"
                                        data-original-title="Edit user">
                                        <i class="material-symbols-rounded opacity-10">edit</i>
                                    </a>

                                </div>


                                <div class="col-md-2">
                                    <form action="{{ route('testimonail.delete', $testimonail->id) }}" method="post">
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

    </div>
                    <!-- Submit Button -->
        <a href="{{route('testimonail.create')}}" class="btn btn-dark btn-md">إنشاء توصية</a>

@endsection
