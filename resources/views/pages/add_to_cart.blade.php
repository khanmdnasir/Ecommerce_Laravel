@extends('layout2')
@section('content')
<section id="cart_items">
    <div class="container ">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $contents=Cart::content();
                    foreach ($contents as $content) {?>

                    <tr class="cartpage">
                        <td class="cart_product">
                            <a href=""><img src="{{asset('images')}}/{{$content->options->image}}" height="80px" width="80px" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$content->name}}</a></h4>
                            <p>Pro ID: {{$content->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{$content->price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button quantity">
                                <input type="hidden" class="rowId" value="{{$content->rowId}}">
                                <input type="hidden" class="product_price" value="{{$content->product_price}}">
                                <a class="cart_quantity_up increment-btn changeQuantity"> + </a>
                                <input class="cart_quantity_input qty" type="text" name="qty" value="{{$content->qty}}" autocomplete="off" size="2">
                                <a class="cart_quantity_down decrement-btn changeQuantity" > - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{$content->weight}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="/delete-cart/{{$content->rowId}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php
                    }?>

                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>{{Cart::subtotal()}}</span></li>
                        <li>Eco Tax <span>{{Cart::tax()}}</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>{{Cart::total()}}</span></li>
                    </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        @if((session()->get('user_name')!=NULL) && (!Cart::count()<=0))
                        <a class="btn btn-default check_out" href="/checkout">Check Out</a>
                        @elseif((session()->get('user_name')==NULL) && (Cart::count()<=0))
                        <a class="btn btn-default check_out" href="/login_check">Check Out</a>
                        @else
                        <a class="btn btn-default check_out" href="/">Please Select a Product First...</a>
                        @endif
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection

