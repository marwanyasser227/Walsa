@extends('backend.components.layout')
@section('dash')
<div class="bg-gradient-dark shadow-dark border-radius-lg px-4 py-3">
                <h6 class="text-white text-capitalize ps-3">جدول العملاء</h6>
              </div>
            </div>
            <div class="card-body px-0 py-4">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">اسم العميل</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المحافظة</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">إجمالي المبالغ المسددة</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">إجمالي المبالغ المحصلة</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">إجمالي الأرباح</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">إجمالي الخسائر</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">اتخذ إجراء</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($clients as $client)
                    <tr>
                        <td>
                          <div class="d-flex px-2 py-1">

                            <div class="d-flex flex-column justify-content-center">
                              <p class="text-xs text-secondary mb-0">{{$client->id}}</p>
                            </div>
                          </div>
                        </td>

                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{$client->name}}</p>
                        </td>


                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-success">{{$client->city->governate->name}}  </span>
                        </td>

                        <td class="align-middle text-center text-sm">
                          <span class="">{{$client->shipments->sum('shipment_costs')}} ج.م</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="">{{$collectedPrice}} ج.م</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="">{{$profits}} ج.م</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="">{{$losses}} ج.م</span>
                        </td>

                        <td class="row justify-content-center align-items-center">

                            <div class="col-md-2">
                                <a href="{{route('users.show' , $client->id)}}" class="p-2 rounded-0 btn btn-md btn-success" data-toggle="tooltip" data-original-title="Edit user">
                                    <i class="material-symbols-rounded opacity-10">visibility</i>
                                  </a>
                            </div>


                            <div class="col-md-2">
                                <form action="{{route('users.delete',$client->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')

                                  <button type="submit" class=" p-2 rounded-0 btn btn-md btn-danger" data-toggle="tooltip" data-original-title="Edit user">   <i class="material-symbols-rounded opacity-10">delete</i></button>
                                </form>

                            </div>



                        </td>
                      </tr>

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
