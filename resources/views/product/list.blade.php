@extends('admin.layout.main')

@section('body')




    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product Lists</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('product#create')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="fa-sharp fa-solid fa-plus"></i>Add product
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    <div class="row justify-content-between">
                        <div class="col-2">
                            <span><i class="fa-solid fa-cart-plus me-2"></i>{{count($getdata)}}</span>
                        </div>
                        <div class="col-3">
                            <h4>Searchkey:{{request('searchkey')}}</h4>
                        </div>
                        <div class="col-4 d-flex">
                           <form action="" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="searchkey" class="form-control" value="{{request('searchkey')}}"  placeholder="Search..">
                            <button class="btn btn-danger text-black"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                            </div>
                           </form>
                        </div>
                    </div>

                  @if (count($getdata) != 0)
                  <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center" style="width:100%;">
                        <thead>
                            <tr>
                                <th class="col-3">image</th>
                                <th>name</th>
                                <th>price</th>
                                <th>Category</th>
                                <th>viewcount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getdata as $data)
                            <tr class="tr-shadow">
                                <td><img src="{{ asset('storage/'.$data->image) }}" style="height:150px;width:150px" alt=""></td>
                                <td>{{$data->name}}</td>
                                <td class="col-6">{{$data->price}}</td>
                                <td>{{$data->category_name}}</td>
                                <td> <i class="fa-sharp fa-solid fa-eye me-2"></i>{{$data->view_count}}</td>
                                <td>
                                    <div class="table-data-feature">
                                       <a href="{{route('view#product',$data->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="fa-sharp fa-solid fa-eye"></i>
                                        </button>
                                       </a>
                                        <a href="{{route('edit#product',$data->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa-sharp fa-solid fa-pen-to-square"></i>
                                            </button></a>
                                        <a href="{{route('delete#product',$data->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fa-sharp fa-solid fa-trash"></i>
                                            </button></a>
                                    </div>
                                </td>
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

{{-- {{$getdata->links()}} --}}

@endsection
