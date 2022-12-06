@extends('admin.layout.main')

@section('body')





    <!-- MAIN CONTENT-->
    <div class="main-content bg">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    <div>
                        <h4>Contact Mails List</h4>
                    </div>

                  @if (count($data) != 0)
                  <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center" style="width:100%;">
                        <thead>
                            <tr>
                                <th >ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>MESSAGE</th>
                                <th>DATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->message}}</td>
                                <td>{{$item->created_at->format('D-F-Y')}}</td>
                                <td><a href="{{route('delete#mail',$item->id)}}"><small><button class="btn btn-danger"><i class="fa-sharp fa-solid fa-trash"></i></button></small></a></td>
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
