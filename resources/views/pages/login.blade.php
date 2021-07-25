@extends('layout2')
@section('content')
<section id="form"><!--form-->
    <div class="container">
        <p style="background-color: red">

            <?php
                if(Session::has('msg')){

                    echo session::get('msg');
                    session()->put('msg', null);
                }?>
            </p>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <form action="/login" method="post">
                        @csrf
                        <input type="email" placeholder="Email Address" name="email" required/>
                        <input type="password" placeholder="Password" name="password" required />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Keep me signed in
                        </span>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form action="/signup" method="POST">
                        @csrf
                        <input type="text" placeholder="Name" name="name" required/>
                        <input type="email" placeholder="Email Address" name="email" required/>
                        <input type="password" placeholder="Password" name="password" required/>
                        <input type="number" placeholder="Mobile" name="mobile" required/>
                        <input type="text" placeholder="Address" name="address" required/>
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection
