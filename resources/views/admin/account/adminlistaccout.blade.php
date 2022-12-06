@extends('admin.layout.main')

@section('body')


    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="row justify-content-between">
                        <div class="col-2">
                            <span><i class="fa-sharp fa-solid fa-user me-2"></i>{{$data->total()}}</span>
                        </div>
                        <div class="col-3">
                            <h4>Searchkey:{{request('searchkey')}}</h4>
                        </div>
                        <div class="col-4 d-flex">
                           <form action="{{route('editadmin#account')}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="searchkey" class="form-control"  placeholder="Search..">
                            <button class="btn btn-danger text-black"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                            </div>
                           </form>
                        </div>
                    </div>

                  @if (count($data) != 0)
                  <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center" style="width:100%;">
                        <thead>
                            <tr>
                                <th >IMAGE</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>GENDER</th>
                                <th>PHONE</th>
                                <th>ADDRESS</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr class="tr-shadow">
                                <td>
                                     <div class="img" style="width:100px " >
                                        @if($item->image == null)
                                        <img src="{{asset('img/default_user.png')}}" class="rounded-pill" style="width:100px;" alt="">
                                        @else                            
                                        <img src="{{asset('storage/'.$item->image)}}" class="width:100px;height:100px;"  class="rounded-pill" alt="John Doe" />
                                        @endif
                                    </div> 
                                </td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->gender}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->address}}</td>
                                <td>
                                   @if($item->id != Auth::user()->id)
                                    <div class="table-data-feature">
                                        <a href="{{route('role#update',$item->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="role">
                                                <i class="fa-sharp fa-solid fa-eye "></i>
                                            </button>
                                        </a>
                                        <a href="{{route('delete#account',$item->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="delete">
                                                <i class="fa-sharp fa-solid fa-trash"></i>
                                            </button></a>
                                    </div>
                                   @endif
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

{{-- {{$data->links()}} --}}

@endsection
