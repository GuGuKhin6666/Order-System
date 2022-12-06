@extends('user.layouts.main')

@section('body')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="tablebox">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($data as $item)
                        <tr>
                            <input type="hidden" id="idpd" value="{{$item->cart_id}}">
                            <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">{{$item->name}}</td>
                            <td class="align-middle">{{$item->price}}Kyats</td>
                            <input type="hidden" value="{{$item->price}}"  id="pricelist">
                          
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-warning btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                   
                                   
                                    <input type="hidden" value="{{$item->qty}}" id="qty">
                                    <input type="text" class="form-control form-control-sm  border-0 text-center" value="{{$item->qty}}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-warning btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <input type="hidden" id="userid" value={{Auth::user()->id}}>
                            <input type="hidden" id="productid" value="{{$item->id}}">
                            <td class="align-middle" id="total">{{$item->price * $item->qty}}Kyats</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btnremove"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Voucher</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="ttprice">{{$totalprice}}Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">4000Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="sum">{{$totalprice + 4000}}Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-warning font-weight-bold my-3 py-3" id="click">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="delete">Delete All Products</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart End -->

    @endsection


    @section('ajaxsession')
    <script src="{{asset('js/cart.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#click').click(function(){
                $orderlist =[];
                $ordercode = Math.floor(Math.random()* 10000000000)
              
               $('#tablebox tbody tr').each(function(index,row){
                  $orderlist.push({
                    'userid' :$(row).find('#userid').val(),
                    'productid':$(row).find('#productid').val(),
                    'qty':$(row).find('#qty').val(),
                    'total': $(row).find('#total').text().replace('Kyats','')*1,
                    'order_code': 'SITHU'+$ordercode,
                  })
               })
               console.log($orderlist);
               
               $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/ajax/orderlist',
                    data : Object.assign({},$orderlist),
                    dataType : 'json',
                    success : function(response){
                     if(response.status == 'success'){
                        window.location.href="http://127.0.0.1:8000/user/home";
                     }
                    }

                })
            })

            $('#delete').click(function(){
                $('#tablebox tbody tr ').remove();
                $('#ttprice').html('0 Kyats');
                $('#sum').html('4000 Kyats');

                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/ajax/delete/order',
                    dataType : 'json',
                })
            })

            $('.btnremove').click(function(){
                console.log('hello')
                $element =   $(this).parents('tr');
                $product_id = $element.find('#idpd').val();
                $element.remove();
                $dd = 0;
                $('#tablebox tr ').each(function(index, row) {
                    $dd += Number($(row).find('#total').text().replace('Kyats', ''));
                });
                $('#ttprice').html(`${$dd}Kyats`)
                $('#sum').html(`${$dd+4000}Kyats`)

                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/ajax/each/data',
                    data : { 'product_id' : $product_id},
                    dataType : 'json',
                    // success : function(response){
                    //  if(response.status == 'success'){
                    //     window.location.href="http://127.0.0.1:8000/user/home";
                    //  }
                    // }

                })


                    })
        })


       
    </script>
    @endsection