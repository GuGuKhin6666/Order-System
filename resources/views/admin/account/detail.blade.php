@extends('admin.layout.main')

@section('body')

  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-8 offset-2 ">
                <div class="card">
                     <div class="card-body row">

                        <div>
                            <i class="fa-sharp fa-solid fa-arrow-left" onclick="history.back()" style="font-size:20px"></i>
                        </div>
                        <div class="card-title col-12">
                            <h3 class="text-center title-2">Acount Profile</h3>
                            <hr>
                        </div>
                          <div class=" align-items-center">
                            <div class=" row  justify-content-center">
                                <div class="col-5">
                                    <div class="image">
                                        <div class="img" style="width:250px">
                                            @if(Auth::user()->image ==null)
                                            <img src="{{asset('img/default_user.png')}}" class="rounded-pill" style="width:250px;" alt="">
                                            @else                            
                                            <img src="{{asset('storage/'.Auth::user()->image)}}" style="width:200px;height:200px;" alt="John Doe" />
                                            @endif
                                        </div>  
                                </div>
                                </div>
                            <div class="col-5 mt-5">
                                <h6><i class="fa-sharp fa-solid fa-circle-user me-3"></i>{{Auth::user()->name}}</h6>
                                <h6><i class="fa-sharp fa-solid fa-envelope me-3"></i>{{Auth::user()->email}}</h6>
                                <h6><i class="fa-sharp fa-solid fa-phone me-3"></i>{{Auth::user()->phone}}</h6>
                                <h6><i class="fa-sharp fa-solid fa-genderless me-3"></i>{{Auth::user()->gender}}</h6>
                                <h6><i class="fa-sharp fa-solid fa-location-pin me-3"></i>{{Auth::user()->address}}</h6>
                                <h6><i class="fa-sharp fa-solid fa-calendar-days me-3"></i>{{Auth::user()->created_at->format('d.F.Y')}}</h6>
                            </div>
                          </div>
                        <div class="row">
                            <div class="col-12 mt-4">
                                <div class="text-center">
                                    <a href="{{route('editadmin#page')}}"><button type="button" class="btn btn-dark text-white"><i class="fa-sharp fa-solid fa-user-pen me-3"></i>Edit Profile</button></a>
                                </div>
                              </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->


@endsection
