@extends('layout2')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->



        <div class="register-req">
            <p>Please fill up the form.....</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">

                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Bill To</p>
                        <div class="form-one">
                            <form action="/checkout-form" method="POST">
                                @csrf
                                <input type="text" name="email" placeholder="Email*" required>
                                <input type="text" name="fname"  placeholder="First Name *" required>

                                <input type="text" name="lname"  placeholder="Last Name *" required>

                                <input type="text" name="address"  placeholder="Address *" required>
                                <input type="text" name="mobile"  placeholder="Mobile Number *" required>
                                <input type="submit" class="btn btn-success" value="Continue">
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
       

    </div>
</section> <!--/#cart_items-->

@endsection
