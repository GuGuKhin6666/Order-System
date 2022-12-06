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
                            <h3 class="text-center title-2">Change Password Form</h3>
                        </div>
                        <hr>
                        <form action="{{route('password#update')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label class="control-label mb-1 mb-3">Old Password</label>
                                <input id="cc-pament" name="oldpassword" type="password" class="form-control @error('oldpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                @error('oldpassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1 mt-2 mb-3">New Password</label>
                                <input id="cc-pament" name="newpassword" type="password"  class="form-control @error('newpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                @error('newpassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1 mt-2 mb-3">Comfirm Password</label>
                                <input id="cc-pament" name="comfirmpassword" type="password"  class="form-control @error(session('passworderror')) is-invalid @enderror @error('comfirmpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                @error('comfirmpassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                
                                @if (session('passworderror'))
                                <div class="invalid-feedback">
                                    {{session('passworderror')}}
                                </div>
                                @endif
                            </div>

                            <div class="mt-3">
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block w-100">
                                    <span id="payment-button-amount"><i class="fa-sharp fa-solid fa-key me-2"></i>Change</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
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
