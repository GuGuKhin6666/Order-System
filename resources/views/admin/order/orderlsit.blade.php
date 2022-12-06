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
                                <h2 class="title-1">Order List</h2>
                            </div>
                            <div>
                               <form action="{{route('data#get')}}" method="get" class="d-flex">
                                @csrf
                                <select name="codeList" class="form-control" id="list">
                                    <option value="">All</option>
                                    <option value="0" @if (request('codeList')=='0') selected @endif>Pending</option>
                                    <option value="1" @if (request('codeList')=='1') selected @endif>Success</option>
                                    <option value="2" @if (request('codeList')=='2') selected @endif>Reject</option>
                                </select>
                                <button type="submit" class="btn btn-dark text-white ms-4">Search</button>
                               </form>
                            </div>
                        </div>
                    </div>
                 
                    <!-- END DATA TABLE -->
                    @if (count($data) != 0)
                    <div class="table-responsive table-responsive-data2">
                      <table class="table table-data2 text-center" style="width:100%;">
                          <thead>
                              <tr>
                                  <th>User Name</th>
                                  <th>Order Data</th>
                                  <th>Order Code</th>
                                  <th>Amount</th>
                                  <th>status</th>
                              </tr>
                          </thead>
                          <tbody id="datalist">
                             @foreach ($data as $item)
                             <input type="hidden" value="{{$item->order_id}}" id="order_idlist">
                                 <tr>
                                    <td>{{$item->user_name}}</td>
                                    <td>{{$item->created_at->format('D Y F')}}</td>
                                    <td><a href="{{route('data#sent',$item->order_code)}}">{{$item->order_code}}</a></td>
                                    <td>{{$item->total_price}}</td>
                                    <td>
                                        <select name="" class="form-control" id="listarray">
                                            <option value="0" @if ($item->status == 0) selected @endif>Pending</option>
                                            <option value="1" @if ($item->status == 1) selected @endif>Success</option>
                                            <option value="2" @if ($item->status == 2) selected @endif>Reject</option>
                                        </select>
                                    </td>
                                 </tr>
                             @endforeach
                          </tbody>
                      </table>
                  </div>
                  @else
                      <h4 class="text-dark text-center mt-5 ">There is no category in following list!</h4>
  
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
</div>

{{-- {{$importdata->links()}} --}}

@endsection

@section('javascript')
    <script>
        $(document).ready(function(){
            $('#list').change(function(){
                $source = $('#list').val();
                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/order/data/get',
                    data : {'list_code' : $source},
                    dataType : 'json',
                    success : function(response){
                      $inputdata ='';
                      for($i=0;$i<response.length;$i++){
                        $month = ['Jun','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                        $dbdate = new Date(response[$i].created_at)
                        $dbdate = $month[$dbdate.getMonth()]+'-'+$dbdate.getDate()+'-'+$dbdate.getFullYear()

                        if(response[$i].status == 0){
                            $dbmessage = `
                            <select name="" class="form-control" id="listarray">
                                            <option value="0"  selected >Pending</option>
                                            <option value="1"  >Success</option>
                                            <option value="2"   >Reject</option>
                                        </select>
                            `;
                        }else if(response[$i].status == 1){
                            $dbmessage = `
                            <select name="" class="form-control" id="listarray">
                                            <option value="0"  >Pending</option>
                                            <option value="1"  selected  >Success</option>
                                            <option value="2"   >Reject</option>
                                        </select>
                            `;
                        }else if(response[$i].status == 2){
                            $dbmessage = `
                            <select name="" class="form-control" id="listarray">
                                            <option value="0"  selected >Pending</option>
                                            <option value="1"  >Success</option>
                                            <option value="2"  selected  >Reject</option>
                                        </select>
                            `;
                        }

                        $inputdata += `
                        <tr>
                                    <td>${response[$i].user_name}</td>
                                    <td>${$dbdate}</td>
                                    <td>${response[$i].order_code}</td>
                                    <td>${response[$i].total_price}</td>
                                    <td>${$dbmessage}</td>
                                 </tr>
                        `;
                        $('#datalist').html($inputdata);
                      }
                    }
                })
            })

            $('#listarray').change(function(){
               $list_id = $('#listarray').val();
               $parentnode = $(this).parents('tr');
               $orderid =$parentnode.find('#order_idlist').val();

               $data ={
                'orderid' : $orderid,
                'status' : $list_id,
               };

               $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/order/change/status',
                    data : $data,
                    dataType : 'json',
                })


            })
        })

      
    </script>

