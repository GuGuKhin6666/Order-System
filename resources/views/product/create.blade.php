@extends('admin.layout.main')

@section('body')

  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href={{route('list#page')}}><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Product Form</h3>
                        </div>
                        <hr>
                        <form action="{{route('createdata#product')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="control-label mb-1 mb-3">Name</label>
                                <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Name">
                                @error('name')
                                <div class="invalid-feedback"> {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1 mb-3 @error('category_id') is-invalid @enderror">Category Title</label>
                                <select name="category_id" class="form-control" id="">
                                   @foreach ($database as $data)
                                       <option value="{{$data->id}}">{{$data->name}}</option>
                                   @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1 mb-3">Description</label>
                                <textarea name="description" id="" cols="30" class="form-control @error('description') is-invalid @enderror" placeholder="Enter your description" rows="10"></textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1 mb-3">Image</label>
                                <input id="cc-pament" name="image" type="file" class="form-control @error('image') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1 mb-3">Price</label>
                                <input id="cc-pament" name="price" type="number" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your price">
                                @error('price')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1 mb-3">Waiting Time</label>
                                <input id="cc-pament" name="waitingtime" type="number" class="form-control @error('waitingtime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your waitingTime">
                                @error('waitingtime')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
 
                            <div class="mt-3">
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block w-100">
                                    <span id="payment-button-amount">Create</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
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
