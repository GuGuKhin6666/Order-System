@extends('user.layouts.main')

@section('body')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5 justify-content-center">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="tablebox">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                       @foreach ($order as $o)
                         <tr>
                            <td>{{$o->created_at->format('D Y F')}}</td>
                            <td>{{$o->order_code}}</td>
                            <td>{{$o->total_price}}</td>
                            <td>
                                @if($o->status == 0)
                                    <span class="text-warning">Pending</span>
                                @elseif ($o->status == 1)
                                    <span class="text-success">Success</span>
                                @elseif ($o->status == 2)
                                    <span class="text-danger">Reject</span>
                                @endif
                            </td>
                         </tr>
                       @endforeach
                    </tbody>
                </table>
                <span>
                    {{$order->links()}}
                </span>
            </div>
        </div>
    </div>

    <!-- Cart End -->

    @endsection


    @section('ajaxsession')
    
    @endsection