@extends('layout2')
@section('content')
<section id="cart_items">
    <div class="container col-sm-12">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <?php
                 $contents=Cart::content();

            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Image</td>
                        <td class="description">Name</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contents as $v_contents) {?>
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{asset('images')}}/{{$v_contents->options->image}}" height="80px" width="80px" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$v_contents->name}}</a></h4>

                        </td>
                        <td class="cart_price">
                            <p>{{$v_contents->price}}</p>
                        </td>
                        <td class="cart_quantity">
                        <div class="cart_quantity_button">
                            <form action='/update-cart' method="post">
                                @csrf
                                <input class="cart_quantity_input" type="text" name="qty" value="{{$v_contents->qty}}" autocomplete="off" size="2" readonly>
                                <input  type="hidden" name="rowId" value="{{$v_contents->rowId}}"  >
                                {{-- <input type="submit" name="submit" value="update" class="btn btn-sm btn-default"> --}}
                            </form>
                        </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{$v_contents->total}}</p>
                        </td>

                    </tr>
                   <?php }?>

                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="paymentCont">
                <form action="/order-place" method="POST">
                    @csrf
                            <div class="headingWrap">
                                    <h3 class="headingTop text-center">Select Your Payment Method</h3>
                                    <p class="text-center">Created with bootsrap button and using radio button</p>
                            </div>
                            <div class="paymentWrap">
                                <div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">
                                    <label class="btn paymentMethod active">
                                        <div class="method visa"></div>
                                        <input type="radio" name="payment_method" value="visa" checked>
                                    </label>
                                    <label class="btn paymentMethod">
                                        <div class="method master-card"></div>
                                        <input type="radio" name="payment_method" value="master">
                                    </label>
                                    <label class="btn paymentMethod">
                                        <div class="method bkash"></div>
                                        <input type="radio" name="payment_method" value="bkash">
                                    </label>
                                     <label class="btn paymentMethod">
                                         <div class="method handcash"></div>
                                        <input type="radio" name="payment_method" value="handcash">
                                    </label>


                                </div>
                            </div>
                            <div class="footerNavWrap clearfix">
                                <div class="btn btn-success pull-left btn-fyi"><span class="glyphicon glyphicon-chevron-left"></span><a href="/">CONTINUE SHOPPING</a> </div>
                                <div class="btn btn-success pull-right btn-fyi"><input type="submit" value="CHECKOUT"><span class="glyphicon glyphicon-chevron-right"></span></div>
                            </div>

                        </div>
                </form>

        </div>
    </div>
</section><!--/#do_action-->
@endsection
