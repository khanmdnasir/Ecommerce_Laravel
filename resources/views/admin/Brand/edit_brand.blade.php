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
        <a href="#">Add Brand</a>
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
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Brand</h2>

        </div>

        <div class="box-content">
            <form class="form-horizontal" action="/update-brand" method="POST" enctype="multipart/form-data">
                @csrf
              <fieldset>
                <input type="hidden" name="brand_id" value="{{$brand->brand_id}}">

                <div class="control-group">
                  <label class="control-label" for="date01">Brand Name</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" name='brand_name' value="{{$brand->brand_name}}">
                  </div>
                </div>
                <div class="control-group">
                    <label class="control-label" >SubCategory Name</label>
                    <div class="controls">
                      <select name="sub_cat_id" >
                          @foreach($sub_categories as $sub_category)
                            <option class="xlarge" @if($brand->category_id==$sub_category->sub_cat_id)
                                selected
                                @endif
                                value="{{$sub_category->sub_cat_id}}">{{$sub_category->sub_cat_name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                <div class="control-group hidden-phone">
                  <label class="control-label" for="textarea2">Brand Description</label>
                  <div class="controls">
                    <textarea class="cleditor" name='brand_description' rows="3">{{$brand->brand_description}}</textarea>
                  </div>
                </div>


                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Update Brand</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
              </fieldset>
            </form>

        </div>
    </div><!--/span-->

</div><!--/row-->
@endsection
