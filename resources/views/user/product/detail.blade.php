@extends('user.layouts.main')
@section('body')


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        @foreach ($data as $item)
                        <div class="carousel-item active">
                            <img class="w-100 " src="{{asset('storage/'.$item->image)}}" height="400px" alt="Image">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{$item->name}}</h3>
                    <h5><i class="fa-sharp fa-solid fa-eye me-4"></i>{{$item->view_count + 1}}</h5>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(99 Reviews)</small>
                    </div>
                    <p class="mb-4">{{$item->description}}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-white border-0 text-center" id="quantity" value="1" min="1">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" id="productid" value="{{$item->id}}">
                        <input type="hidden" id="userid" value={{Auth::user()->id}}>
                        
                            <button  class="btn btn-warning px-3" id="click"><i class="fa fa-shopping-cart mr-1"></i> Add To
                                Cart</button>
                  
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                   @foreach ($datas as $item)
                   <div class="product-item bg-light">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{asset('storage/'.$item->image)}}" style="height:200px;" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="{{route('detail#product',$item->id)}}"><i class="fa-sharp fa-solid fa-circle-info"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">{{$item->name}}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>{{$item->price}}</h5><h6 class="text-muted ml-2"><del>{{$item->price+25000}}</del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('ajaxsession')

    <script>
        $(document).ready(function(){

            $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/ajax/viewcount',
                    data : {'productid' : $('#productid').val()},
                    dataType : 'json',
                })
          
            $('#click').click(function(){
                $source ={
                    'userid' : $('#userid').val(),
                    'productid' : $('#productid').val(),
                    'quantity' : $('#quantity').val(),
                };

                console.log($source);
                
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/ajax/addtocart',
                    data : $source,
                    dataType : 'json',
                    success : function(response){
                      if(response.status == 'success'){
                        window.location.href = 'http://127.0.0.1:8000/user/home'
                      }
                    }

                })
            })
    });
    </script>

@endsection