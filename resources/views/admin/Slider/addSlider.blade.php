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
        <a href="#">Add Slider</a>
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
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Slide</h2>

        </div>

        <div class="box-content">
            <form class="form-horizontal" action="create-slider" method="POST">
                @csrf
              <fieldset>

                <div class="control-group">
                  <label class="control-label" for="date01">Slider Name</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" name='slider_name' required>
                  </div>
                </div>

                <div class="control-group hidden-phone">
                  <label class="control-label" for="textarea2">Slider Description</label>
                  <div class="controls">
                    <textarea class="cleditor" name='slider_description' rows="3" required></textarea>
                  </div>
                </div>
                <div class="control-group">
                    <label class="control-label" >Product Image</label>
                    <div class="controls">
                      <input type="file" class="input-xlarge" name='slider_image' required>
                    </div>
                  </div><div class="control-group">
                    <label class="control-label" >Price Image</label>
                    <div class="controls">
                      <input type="file" class="input-xlarge" name='slider_priceImage' required>
                    </div>
                  </div>
                <div class="control-group">
                    <label class="control-label" for="date01">Publication Status</label>
                    <div class="controls">
                      <input type="checkbox"  name='publication_status' value='1' >
                    </div>
                  </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Add Slide</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
              </fieldset>
            </form>

        </div>
    </div><!--/span-->

</div><!--/row-->
@endsection
