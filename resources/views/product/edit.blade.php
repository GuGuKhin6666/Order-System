@extends('admin.layout.main')

@section('body')

  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div>
                    <i class="fa-sharp fa-solid fa-arrow-left" onclick="history.back()" style="font-size:20px"></i>
                </div>
            </div>
            <div class="col-lg-10 offset-1 ">
                <div class="card">
                     <div class="card-body row">
                        <div class="card-title col-12">
                            <h3 class="text-center title-2 mt-2">Edit Product</h3>
                            <hr class="mt-3">
                        </div>
                        <form action="{{route('update#data')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                          <div class="row justify-content-center ">
                            <div class="col-4">
                                <div class="img"> 
                                    <img src="{{asset('storage/'.$datas->image)}}" style="height: 200px" class="image-thumbail" alt="">
                                </div>
                               
                                <div class="my-3">
                                    <input type="file" class="form-control @error('image') is-invalid   @enderror"  name="image">
                                    @error('name')
                                        <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="my-3">
                                    <a href="#" style="width:100%" ><button class="btn btn-dark text-white col-12"><i class="fa-solid fa-pen-nib me-3"></i>Update</button></a>
                                </div>

                                <input type="hidden" name="productid" value="{{$datas->id}}">
                            </div>
                            <div class="col-7">
                                <div class="form-group">
                                    <label class="control-label mb-1 mt-2 mb-1">Name</label>
                                    <input id="cc-pament" name="name" type="text" value="{{old('name',$datas->name)}}"  class="form-control" aria-required="true" aria-invalid="false" >
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1 mt-2 mb-1">Description</label>
                                    <textarea name="description" class="form-control" id="" placeholder="Enter your description" cols="30" rows="10">{{old('description',$datas->description)}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1 mt-2 mb-1">Price</label>
                                    <input id="cc-pament" name="price" type="number" value="{{old('price',$datas->price)}}"  class="form-control" aria-required="true" aria-invalid="false" >
                                </div>

                                <div class="form-group">
                                   <label for="">Category</label>
                                   <select name="category_id" class="form-control">
                                    <option value="">Choose Category...</option>
                                    @foreach ($category as $c)
                                    <option value="{{ $c->id }}" @if($datas->category_id == $c->id) selected @endif>{{ $c->name }}</option>
                                    @endforeach
                                   </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1 mt-2 mb-1">waitingTime</label>
                                    <input id="cc-pament" name="waitingtime" type="number" value="{{$datas->waitingtime}}"  class="form-control" aria-required="true" aria-invalid="false" >
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1 mt-2 mb-1">View</label>
                                    <input id="cc-pament" name="view_count" type="number"  class="form-control" {{$datas->view_count}} aria-required="true" aria-invalid="false" disabled>
                                </div>
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
