@extends('user.layouts.main')

@section('body')
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="price-all">
                        <label class="" for="price-all">Category</label>
                        <span class="badge border font-weight-normal"></span>
                    </div>
                    <a href="{{route('user#home')}}" class="ms-4"><label for="">All</label></a>
                    @foreach ($data as $item)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 mt-3">  
                        <a href="{{route('filter#product',$item->id)}}"><label for="price-1">{{$item->name}}</label></a>
                    </div>
                       @endforeach  
                    </div>
                </form>
            
            <!-- Price End -->
            
            <!-- Color Start -->

            <!-- Color End -->

            <!-- Size Start -->
            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            <a href="{{route('cart#page')}}"><button type="button" class="btn btn-secondary text-white position-relative">
                                <i class="fa-sharp fa-solid fa-cart-shopping"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{count($cart)}}
                                  <span class="visually-hidden">unread messages</span>
                                </span>
                              </button></a>
                              <a href="{{route('see#order')}}" class="ms-3"><button type="button" class="btn btn-secondary text-white position-relative">
                                    <span class="">History</span>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{count($orderdata)}}
                                  <span class="visually-hidden">unread messages</span>
                                </span>
                              </button></a>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <div>
                                    <select name="select" class="form-control" id="optionvalue">
                                        <option value="">Chose your option</option>
                                        <option value="asc">Asceding</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             @if (count($data) != null)

             <div class="row" id="form">
                @foreach ($data as $item)
                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                   <div class="product-item bg-light mb-4" id="form">
                       <div class="product-img position-relative overflow-hidden">
                           <img class="img-fluid w-100 " src="{{asset('storage/'.$item->image)}}" style="height: 250px"alt="">
                           <div class="product-action">
                               <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                               <a class="btn btn-outline-dark btn-square" href="{{route('detail#product',$item->id)}}"><i class="fa-sharp fa-solid fa-circle-info"></i></a>
                           </div>
                       </div>
                       <div class="text-center py-4">
                           <a class="h6 text-decoration-none text-truncate" href="">  {{$item->name}}</a>
                           <div class="d-flex align-items-center justify-content-center mt-2">
                               <h5>{{$item->price}}kyats</h5><h6 class="text-muted ml-2"><del>{{$item->price+25000}}</del></h6>
                           </div>
                           <div class="d-flex align-items-center justify-content-center mb-1">
                               <small class="fa fa-star text-primary mr-1"></small>
                               <small class="fa fa-star text-primary mr-1"></small>
                               <small class="fa fa-star text-primary mr-1"></small>
                               <small class="fa fa-star text-primary mr-1"></small>
                               <small class="fa fa-star text-primary mr-1"></small>
                           </div>
                       </div>
                   </div>
               </div>
                @endforeach
               </div>
             @else
                 <h2 class="text-danger text-center">There is no products here</h2>
             @endif
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>

@endsection

@section('ajaxsession')
   <script>
    $(document).ready(function(){
      $('#optionvalue').change(function(){
        $movement = $('#optionvalue').val();
        if($movement == 'asc'){
            $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/user/ajax/data',
                data : {'status' : 'asc'},
                dataType : 'json',
                success : function(response){
                    $list ='';
                    for($i=0;$i<response.length;$i++){
                       $list +=`
                       <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                       <div class="product-item bg-light mb-4" >
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100 " src="{{asset('storage/${response[$i].image}')}}" style="height: 250px"alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href=""> ${response[$i].name}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>${response[$i].price}kyats</h5><h6 class="text-muted ml-2"><del>${response[$i].price+25000}</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                            </div>
                        </div>
                    </div>
                </div>
                       `;
                    }
                    $('#form').html($list)
            }})
       }else if($movement == 'desc'){
        $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/user/ajax/data',
                data : {'status' : 'desc'},
                dataType : 'json',
                success : function(response){
                    $list ='';
                    for($i=0;$i<response.length;$i++){
                       $list +=`
                       <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                       <div class="product-item bg-light mb-4" >
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100 " src="{{asset('storage/${response[$i].image}')}}" style="height: 250px"alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href=""> ${response[$i].name}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>${response[$i].price}kyats</h5><h6 class="text-muted ml-2"><del>${response[$i].price+25000}</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                            </div>
                        </div>
                    </div>
                </div>
                       `;
                    }
                    $('#form').html($list)
                }
            })
       }
    })
    })
      
   </script>
@endsection