@extends('admin_layout')
@section('admin_content')
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Home</a>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">Add Product</a>
    </li>
</ul>
<p style="background-color: red">

    <?php
        if(Session::has('msg')){

            echo session::get('msg');
            session()->put('msg', null);
        }elseif (Session::has('fail_msg')) {
            echo session::get('fail_msg');
            session()->put('fail_msg',null);
        }
    ?>
    </p>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Product</h2>

        </div>

        <div class="box-content">
            <form class="form-horizontal" action="/update-product" method="POST" enctype="multipart/form-data">
                @csrf
              <fieldset>

                <div class="control-group">
                  <label class="control-label" >Category</label>
                  <div class="controls">
                        <select name="category_id" >
                            @foreach ($categories as $cat)
                            <option @if($product->category_id==$cat->category_id)
                                selected
                                @endif
                                value="{{$cat->category_id}}">{{$cat->category_name}}</option>
                            @endforeach
                        </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >SubCategory</label>
                  <div class="controls">
                        <select name="sub_cat_id" >
                            @foreach ($sub_categories as $sub_cat)
                            <option @if($product->sub_cat_id==$sub_cat->sub_cat_id)
                                selected
                                @endif
                                value="{{$sub_cat->sub_cat_id}}">{{$sub_cat->sub_cat_name}}</option>
                            @endforeach
                        </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Brand</label>
                  <div class="controls">
                    <select name="brand_id" >
                        @foreach ($brands as $brand)
                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Product Name</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" name='product_name' value="{{$product->product_name}}" required>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Product Short Description</label>
                  <div class="controls">
                    <textarea class="cleditor" name='product_short_description' rows="3" required>{{$product->product_short_description}}</textarea>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Product Long Description</label>
                  <div class="controls">
                    <textarea class="cleditor" name='product_long_description' rows="3" >{{$product->product_long_description}}</textarea>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Product Price</label>
                  <div class="controls">
                    <input type="number" class="input-xlarge" name='product_price' value="{{$product->product_price}}" required>
                  </div>
                </div>
                {{-- <div class="control-group">
                  <label class="control-label" >Product Image</label>
                  <div class="controls">
                    <input type="file" class="input-xlarge" name='product_image'  required>
                  </div>
                </div> --}}
                <div class="control-group">
                  <label class="control-label" >Product Size</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" name='product_size' value="{{$product->product_size}}" >
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Product Color</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" name='product_color' value="{{$product->product_color}}" >
                  </div>
                </div>




                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Update Product</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
              </fieldset>
            </form>

        </div>
    </div><!--/span-->

</div><!--/row-->
@endsection
