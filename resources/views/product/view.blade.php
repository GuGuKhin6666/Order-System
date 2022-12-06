@extends('admin.layout.main')

@section('body')

  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-8 offset-2 ">
                <div class="card">
                     <div class="card-body row">
                        <div class="card-title col-12">
                            <div>
                                <button class="btn btn-dark text-white" onclick="history.back()"><i class="fa-sharp fa-solid fa-arrow-left"></i></button>
                              </div>
                            <h3 class="text-center title-2">Product Detail View</h3>
                            <hr>
                        </div>
                        <form action="#" method="post" novalidate="novalidate">
                            @csrf
                          <div class="row justify-content-center align-items-center">
                            <div class="col-5">
                                <div class="image">
                                    <img src="{{asset('storage/'.$productdata->image)}}" style="height: 200px;width:250px;" class="image-thumbail" alt="">
                                </div>
                            </div>
                            <div class="col-5">
                                <h6><i class="fa-sharp fa-solid fa-circle-user me-3"></i>{{$productdata->name}}</h6>
                                <h6><i class="fa-sharp fa-solid fa-envelope me-3"></i>{{$productdata->description}}</h6>
                                <h6><i class="fa-sharp fa-solid fa-phone me-3"></i>{{$productdata->price}}</h6>
                                <h6><i class="fa-sharp fa-solid fa-genderless me-3"></i>{{$productdata->waitingtime}}</h6>
                                <h6><i class="fa-sharp fa-solid fa-location-pin me-3"></i>{{$productdata->view_count}}</h6>
                                <h6><i class="fa-sharp fa-solid fa-calendar-days me-3"></i>{{$productdata->created_at->format('j F Y')}}</h6>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->


@endsection
