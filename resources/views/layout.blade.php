@extends('layout2')
@section('main')
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php $slides=DB::table('slider')->where('publication_status',1)->get();
                        foreach ($slides as $slide) {?>
                            @if($slide->slider_id==1)
                        <li data-target="#slider-carousel" data-slide-to="{{$slide->slider_id}}" class="active"></li>
                        @endif
                        <li data-target="#slider-carousel" data-slide-to="{{$slide->slider_id}}"></li>
                        <?php }?>

                    </ol>

                    <div class="carousel-inner">
                        <?php $slides=DB::table('slider')->where('publication_status',1)->get();
                        foreach ($slides as $slide) {?>
                            @if($slide->slider_id==1)
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>{{$slide->slider_name}}</span></h1>
                                    {{-- <h2>Free E-Commerce Template</h2> --}}
                                    <p>{{$slide->slider_description}}</p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{asset('images/slider')}}/{{$slide->slider_image}}" class="girl img-responsive" alt="" />
                                    <img src="{{asset('images/prices')}}/{{$slide->slider_priceImage}}"  class="pricing" alt="" />
                                </div>
                            </div>
                            @endif
                            <div class="item ">
                                <div class="col-sm-6">
                                    <h1><span>{{$slide->slider_name}}</span></h1>
                                    {{-- <h2>Free E-Commerce Template</h2> --}}
                                    <p>{{$slide->slider_description}}</p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{asset('images/slider')}}/{{$slide->slider_image}}" class="girl img-responsive" alt="" />
                                    <img src="{{asset('images/prices')}}/{{$slide->slider_priceImage}}"  class="pricing" alt="" />
                                </div>
                            </div>
                            <?php
                        }?>


                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>

                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        <div class="panel panel-default">
                            <?php $categories=DB::table('category')->where('publication_status',1)->get();
                            foreach($categories as $category){  ?>

                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="/ProductByCategory/{{$category->category_id}}" >{{$category->category_name}}</a>
                                    <a data-toggle="collapse" data-parent="#accordian" href="#{{$category->category_id}}" >
                                        <span class="badge pull-right"><i class="fa fa-plus" ></i></span>

                                    </a>
                                </h4>
                            </div>
                            <div id="{{$category->category_id}}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php $sub_categories=DB::table('sub_category')->where('category_id',$category->category_id)->where('publication_status',1)->get();
                                    foreach ($sub_categories as $sub_category) {?>
                                    <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="/ProductBySubCategory/{{$sub_category->sub_cat_id}}" >{{$sub_category->sub_cat_name}}</a>
                                    <a data-toggle="collapse" data-parent="#accordian-inner" href="#sub{{$sub_category->sub_cat_id}}" >
                                        <span class="badge pull-right"><i class="fa fa-plus" ></i></span>

                                    </a>
                                </h4>
                                </div>
                                <div id="sub{{$sub_category->sub_cat_id}}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <?php $brands=DB::table('brand')->where('sub_cat_id',$sub_category->sub_cat_id)->where('publication_status',1)->get();
                                            foreach ($brands as $brand) {?>
                                            <li><a href="/ProductByBrand/{{$brand->brand_id}}">{{$brand->brand_name}} </a></li>

                                            <?php }?>

                                        </ul>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        </div>

                        <?php
                        }?>

                    </div>

                </div>





                    <div class="price-range"><!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well text-center">
                             <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                             <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div><!--/price-range-->

                    <div class="shipping text-center"><!--shipping-->
                        <img src="{{asset('images/home/shipping.jpg')}}" alt="" />
                    </div><!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                @yield('content')
            </div>
    </div>
</section>
@endsection
