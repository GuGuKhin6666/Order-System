@extends('admin.layout.main')

@section('body')




    <!-- MAIN CONTENT-->
    <div class="main-content bg">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <div>
                                    <i class="fa-sharp fa-solid fa-arrow-left" onclick="history.back()" style="font-size:20px"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="width: 24rem;">
                        <div class="card-header">
                         <h6 class="text-center mb-0"> Order Lists</h6> <br>
                          <span class="text-warning ps-5 ms-4"><i class="fa-sharp fa-solid fa-triangle-exclamation"></i>Include Delivery Charge</span>
                        </div>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">
                            <div class="row mb-3">
                                <div class="col"><i class="fa-sharp fa-solid fa-user text-warning me-2"></i>Customer Name</div>
                                <div class="col" >{{$data[0]['user_name']}}</div>
                           </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row mb-3">
                                <div class="col"><i class="fa-sharp fa-solid fa-barcode text-warning  me-2"></i>Order Code</div>
                                <div class="col" >{{$data[0]['order_code']}}</div>
                           </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row mb-3">
                                <div class="col"><i class="fa-sharp fa-solid fa-calendar-days text-warning  me-2"></i>Order Date</div>
                                <div class="col" >{{$data[0]['created_at']->format('D-F-Y')}}</div>
                           </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row mb-3">
                                <div class="col"><i class="fa-sharp fa-solid fa-money-bill-1-wave text-warning  me-2"></i>Totla Price</div>
                                <div class="col" >{{$code->total_price}}</div>
                           </div>
                          </li>
                        </ul>
                      </div>
                   

                  @if (count($data) != 0)
                  <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center" style="width:100%;">
                        <thead>
                            <tr>
                                <th >Order Id</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Order Date</th>
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{$item->orderlists_id}}</td>
                                    <td><img src="{{asset('storage/'.$item->image)}}" width="150px" style="height: 150px" class="img-thumbnail" alt=""></td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->created_at->format('D-F-Y')}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td>{{$item->total}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <h4 class="text-dark text-center mt-5 ">There is no category in following list!</h4>

                  @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
</div>

{{-- {{$importdata->links()}} --}}

@endsection
