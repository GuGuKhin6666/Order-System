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
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Category Form</h3>
                        </div>
                        <hr>
                        <form action="{{route('update#pagelist')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="userid" value="{{$edit->id}}">
                                <label class="control-label mb-1 mb-3">Name</label>
                                <input id="cc-pament" name="categoryname" type="text" value="{{$edit->name}}" class="form-control @error('categoryname') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                @error('categoryname')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block w-100">
                                    <span id="payment-button-amount">Update</span>
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
