@extends('user.layouts.main')
@section('body')

<!-- MAIN CONTENT-->
<div class="main-content ">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="row">
                    <div class="col-3 bg-light">
                        <div class="text-center mt-3">
                            <i class="fa-sharp fa-solid fa-location-dot text-primary"></i>
                            <br>
                          <span class="mb-0 font-weight-bold">Address</span> <br>
                            <span class="font-size">Hlegu</span> <br>
                            <span class="font-size">Yangon</span>
                        </div>
                        <div class="text-center my-4">
                            <i class="fa-sharp fa-solid fa-phone text-primary"></i><br>
                            <span class="mb-0 font-weight-bold">Phone</span> <br>
                            <span class="font-size" >+959 614 8817 8</span> <br>
                            <span class="font-size" >+959 614 8817 8</span>
                        </div>
                        <div class="text-center mb-3">
                            <i class="fa-sharp fa-solid fa-envelope text-primary"></i><br>
                            <span class="mb-0 font-weight-bold">Email</span><br>
                            <span class="font-size">sithu@gmail.com</span> <br>
                            <span class="font-size">kyawkyaw@gmail.com</span>
                        </div>
                    </div>
                    <div class="col-9 bg-light frame p-4 ">
                        <div>
                            <h5 class="text-primary font-weight-bold">Send us a message</h5>
                            <p class="font-size-small">If yu have any work from me or any types of quries related to mt tutorial,you can send me message to here.It's my preasure to help you.</p>
                        </div>
                        <div>
                            <form action="{{route('contact#me')}}" method="post">
                                @csrf
                                <input type="text" name="username" placeholder="Enter your name" class="form-control">
                                @error('username')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                                <input type="email" name="useremail" placeholder="Enter your email" class="form-control my-3">
                                @error('useremail')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                               <textarea name="usermessage" id="" cols="30" placeholder="Enter your message" class="form-control" rows="5"></textarea>
                               @error('usermessage')
                               <small style="color: red">{{$message}}</small>
                               @enderror
                               <div class="mt-3">
                               <button type="submit" class="btn btn-primary text-white">Send Now</button>
                               </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection