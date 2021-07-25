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
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Add SubCategory</h2>

        </div>

        <div class="box-content">
            <form class="form-horizontal" action="/update-sub_cat" method="POST" enctype="multipart/form-data">
                @csrf
              <fieldset>
                <input type="hidden" name="sub_cat_id" value="{{$sub_category->sub_cat_id}}">

                <div class="control-group">
                  <label class="control-label" >SubCategory Name</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" name='sub_cat_name' value="{{$sub_category->sub_cat_name}}">
                  </div>
                </div>
                <div class="control-group">
                    <label class="control-label" >Category Name</label>
                    <div class="controls">
                      <select name="category_id" >
                          @foreach($categories as $category)
                            <option class="xlarge" @if($sub_category->category_id==$category->category_id)
                                selected
                                @endif
                                value="{{$category->category_id}}">{{$category->category_name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                <div class="control-group hidden-phone">
                  <label class="control-label" for="textarea2">SubCategory Description</label>
                  <div class="controls">
                    <textarea class="cleditor" name='sub_cat_description' rows="3">{{$sub_category->sub_cat_description}}</textarea>
                  </div>
                </div>


                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Update SubCategory</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
              </fieldset>
            </form>

        </div>
    </div><!--/span-->

</div><!--/row-->
@endsection
