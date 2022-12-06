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
                            <h3 class="text-center title-2 mt-2">Edit Admin Profile</h3>
                            <hr class="mt-3">
                        </div>
                        <form action="{{route('update#profile',Auth::user()->id)}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                          <div class="row justify-content-center ">
                            <div class="col-4">
                                <div class="img">
                                    @if(Auth::user()->image ==null)
                                    <img src="{{asset('img/default_user.png')}}" class="rounded-pill" style="width:250px;" alt="">
                                    @else                            
                                    <img src="{{asset('storage/'.Auth::user()->image)}}" style="width:250px;height:250px;" alt="John Doe" />
                                    @endif
                                </div>  
                               
                                <div class="mt-3">
                                    <input type="file" name="image" class="form-control @error('image') is-invalid   @enderror">
                                    @error('image')
                                        <small style="color: red">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="my-3">
                                    <a href="#" style="width:100%" ><button class="btn btn-dark text-white col-12"><i class="fa-solid fa-pen-nib me-3"></i>Update</button></a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="control-label mb-1 mt-2 mb-1">Name</label>
                                    <input id="cc-pament" name="name" type="name" value={{old('name',Auth::user()->name)}}  class="form-control" aria-required="true" aria-invalid="false" >
                                    @error('name')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1 mt-2 mb-1">Email</label>
                                    <input id="cc-pament" name="email" type="email" value={{old('email',Auth::user()->email)}}  class="form-control" aria-required="true" aria-invalid="false" >
                                    @error('email')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1 mt-2 mb-1">Phone</label>
                                    <input id="cc-pament" name="phone" type="phone" value={{old('phone',Auth::user()->phone)}}  class="form-control" aria-required="true" aria-invalid="false" >
                                    @error('phone')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Gender</label>
                                    <select class="form-control @error('gender') is-invalid   @enderror"  name="gender" id="">
                                    <option value="">Chose your Gender</option>
                                    <option value="male" @if (Auth::user()->gender == 'male') selected   @endif>Male</option>
                                    <option value="female" @if (Auth::user()->gender == 'female') selected   @endif>Female</option>
                                    </select>
                                    @error('gender')
                                      <small style="color: red">{{$message}}</small>
                                    @enderror
                                  </div>

                                <div class="form-group">
                                    <label class="control-label mb-1 mt-2 mb-1">Address</label>
                                    <input id="cc-pament" name="address" type="text" value={{old('address',Auth::user()->address)}}  class="form-control" aria-required="true" aria-invalid="false" >
                                    @error('address')
                                    <small style="color: red">{{$message}}</small>
                                @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1 mt-2 mb-1">Role</label>
                                    <input id="cc-pament" name="role" type="role" value={{old('role',Auth::user()->role)}}  class="form-control" aria-required="true" aria-invalid="false" disabled>
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
