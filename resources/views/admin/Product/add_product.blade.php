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
        if(Session::has('success')){

            echo session::get('success');
            session()->put('success', null);
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
            <form class="form-horizontal" action="/create-product" method="POST" enctype="multipart/form-data">
                @csrf
              <fieldset>

                <div class="control-group">
                  <label class="control-label" >Category</label>
                  <div class="controls">
                        <select id="category_id" name="category_id" >
                            <option value="">--Select Category--</option>
                            @foreach ($categories as $key=>$cat)

                            <option value="{{$key}}">{{$cat}}</option>
                            @endforeach
                        </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >SubCategory</label>
                  <div class="controls">
                        <select id="sub_cat_id" name="sub_cat_id" >

                        </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Brand</label>
                  <div class="controls">
                    <select id="brand_id" name="brand_id" >

                    </select>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label" >Product Name</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" name='product_name' required>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Product Short Description</label>
                  <div class="controls">
                    <textarea class="cleditor" name='product_short_description' rows="3" ></textarea>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Product Long Description</label>
                  <div class="controls">
                    <textarea class="cleditor" name='product_long_description' rows="3" ></textarea>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Product Price</label>
                  <div class="controls">
                    <input type="number" class="input-xlarge" name='product_price' required>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Product Image</label>
                  <div class="controls">
                    <input type="file" class="input-xlarge" name='product_image' required>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Product Size</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" name='product_size' >
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" >Product Color</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" name='product_color' >
                  </div>
                </div>



                <div class="control-group">
                    <label class="control-label" >Publication Status</label>
                    <div class="controls">
                      <input type="checkbox"  name='publication_status' value='1' >
                    </div>
                  </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Add Product</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
              </fieldset>
            </form>

        </div>
    </div><!--/span-->

</div><!--/row-->
@endsection
@section('script')
    <script >
         $(document).ready(function() {
        $('#category_id').on('change', function() {
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{url('get_sub_cat')}}"+'/'+category_id,
                    type: "GET",


                    success:function(data) {

                      if(data){
                        $('#sub_cat_id').empty();

                        $('#sub_cat_id').append('<option value="">-- Select SubCategory --</option>');
                        $.each(data, function(key, value){
                        $('#sub_cat_id').append('<option value="'+ key +'">' + value+ '</option>');
                    });
                  }else{
                    $('#sub_cat_id').empty();
                  }
                  }
                });
            }else{
              $('#sub_cat_id').empty();
            }
        });
        $('#sub_cat_id').on('change', function() {
            var sub_cat_id = $(this).val();
            if(sub_cat_id) {
                $.ajax({
                    url: "{{url('get_brand')}}"+'/'+sub_cat_id,
                    type: "GET",

                    success:function(data) {
                        //console.log(data);
                      if(data){
                        $('#brand_id').empty();

                        $('#brand_id').append('<option value="">-- Select Brand --</option>');
                        $.each(data, function(key, value){
                        $('#brand_id').append('<option value="'+ key +'">' + value+ '</option>');
                    });
                  }else{
                    $('#brand_id').empty();
                  }
                  }
                });
            }else{
              $('#brand_id').empty();
            }
        });
    });
    </script>


@endsection
