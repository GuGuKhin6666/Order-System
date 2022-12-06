@extends('admin.layout.main')

@section('body')




    <!-- MAIN CONTENT-->
    <div class="main-content bg">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->

                    <div class="row justify-content-between">
                        <div class="col-2">
                            <span><i class="fa-sharp fa-solid fa-user me-2"></i>{{count($data)}}</span>
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
                                <th>ROLE</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        
                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    @if ($item->image == null)
                                      <img src="{{asset('img/default_user.png')}}" width="150px" height="150px" alt="">
                                    @else
                                    <img src="{{asset('storage/'.$item->image)}}" width="150px" style="height: 150px"  alt="">                            
                                    @endif
                                </td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->gender}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->address}}</td>
                                <td>            
                                  @if ($item->id != Auth::user()->id)
                                  <input type="hidden" id="userid" value="{{$item->id}}">
                                  <select name="" class="form-control click" >
                                      <option value="admin" @if ($item->role == 'admin') selected  @endif>Admin</option>
                                      <option value="user" @if ($item->role == 'user') selected  @endif>user</option>
                                  </select>
                                  @endif
                                </td>
                            </tr>
                        @endforeach
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

@section('javascript')
    <script>
        $(document).ready(function(){

            $('.click').change(function(){
                $datalist = $('.click').val(),
                $parentnode = $(this).parents('tr'),
                $userid = $parentnode.find('#userid').val(),
                $list ={
                    'userid' : $userid,
                    'role' : $datalist,
                }
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/admin/datalistdate',
                    data : $list,
                    dataType : 'json',
                })
                location.reload();
            })
        })
    </script>
@endsection


