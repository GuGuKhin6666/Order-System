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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('create#page')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="fa-sharp fa-solid fa-plus"></i>add Category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    @if (session('deletemessage'))
                    <div class="row">
                        <div class="alert alert-warning alert-dismissible fade show col-3 offset-9" role="alert">
                            <span>{{session('deletemessage')}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif

                    <div class="row justify-content-between">
                        <div class="col-2">
                            <span><i class="fa-solid fa-cart-plus me-2"></i>{{$importdata->total()}}</span>
                        </div>
                        <div class="col-3">
                            <h4>Searchkey:{{request('searchkey')}}</h4>
                        </div>
                        <div class="col-4 d-flex">
                           <form action="{{route('list#page')}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="searchkey" class="form-control"  placeholder="Search..">
                            <button class="btn btn-danger text-black"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                            </div>
                           </form>
                        </div>
                    </div>

                  @if (count($importdata) != 0)
                  <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center" style="width:100%;">
                        <thead>
                            <tr>
                                <th >id</th>
                                <th>name</th>
                                <th>created_date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($importdata as $data)
                            <tr class="tr-shadow">
                                <td>{{$data->id}}</td>
                                <td class="col-6">{{$data->name}}</td>
                                <td>{{$data->created_at->format('j F Y' )}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{route('edit#pagelist',$data->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa-sharp fa-solid fa-pen-to-square text-success"></i>
                                            </button></a>
                                        <a href="{{route('category#delete',$data->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fa-sharp fa-solid fa-trash text-danger"></i>
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

{{$importdata->links()}}

@endsection
