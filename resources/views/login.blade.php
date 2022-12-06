@extends('layouts.master')
@section('content')


<div class="login-form">
    <form action="{{route('login')}}" method="POST">
        @error('terms')
        <small style="color: red">{{$message}}</small>
        @enderror
        @csrf
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full my-3" type="email" name="email" placeholder="Email">
            @error('email')
        <small style="color: red">{{$message}}</small>
        @enderror
        </div>
        <div class="form-group" style="margin-top: 20px">
            <label>Password</label>
            <input class="au-input au-input--full my-3" type="password" name="password" placeholder="Password">
            @error('password')
        <small style="color: red">{{$message}}</small>
        @enderror
        </div>

        <button class="au-btn au-btn--block au-btn--green m-b-20" style="margin-top: 20px" type="submit">sign in</button>

    </form>
    <div class="register-link">
        <p>
            Don't you have account?
            <a href={{route('register#page')}}>Sign Up Here</a>
        </p>
    </div>
</div>
@endsection
