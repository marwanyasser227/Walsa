
@extends('backend.components.layout')
@section('dash')

    <div class="bg-gradient-dark shadow-dark border-radius-lg px-4 py-3">
        <h6 class="text-white text-capitalize ps-3">جدول المحافظات </h6>

    </div>
    <div class="card-body px-0 py-4">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الاسم
                            </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المنطقة
                            </th>

                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">القيام
                            بإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($governates as $governate)
                        <tr>

                            <td>
                                <p class="text-start">
                                    {{ $governate->id }}

                                </p>
                            </td>

                            <td>
                                <p class="text-center">
                                    {{ $governate->name }}

                                </p>
                            </td>
                            <td>
                                <p class="text-center">
                                    {{ $governate->area->name }}

                                </p>
                            </td>




                            <td class="row justify-content-center align-items-center">


                                <div class="col-md-2">
                                    <a href="{{ route('governorates.show', $governate->id) }}"
                                        class=" p-2 rounded-0 btn btn-md btn-success" data-toggle="tooltip"
                                        data-original-title="Edit user">
                                        <i class="material-symbols-rounded opacity-10">visibility</i>
                                    </a>

                                </div>

                                <div class="col-md-2">
                                    <a href="{{ route('governorates.edit', $governate->id) }}"
                                        class=" p-2 rounded-0 btn btn-md btn-warning" data-toggle="tooltip"
                                        data-original-title="Edit user">
                                        <i class="material-symbols-rounded opacity-10">edit</i>
                                    </a>

                                </div>


                                <div class="col-md-2">
                                    <form action="{{ route('governorates.destroy', $governate->id) }}" method="post">
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
      <!-- Submit Button -->
      <a href="{{route('governorates.create')}}" class="btn btn-dark btn-md mt-3">إنشاء محافظة</a>
    </div>

@endsection
