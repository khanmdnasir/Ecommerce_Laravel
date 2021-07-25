@extends('admin_layout')
@section('admin_content')
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Home</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">Brands</a></li>
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
            <h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                  <tr>
                      <th>Brand Id</th>
                      <th>Brand Name</th>
                      <th>SubCategory Name</th>
                      <th>Brand Description</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($brands as $brand)

                  <tr>
                      <td>{{$brand->brand_id}}</td>
                      <td>{{$brand->brand_name}}</td>
                      @foreach ($sub_categories as $sub_category)
                        @if($brand->sub_cat_id==$sub_category->sub_cat_id)
                        <td>{{$sub_category->sub_cat_name}}</td>
                        @endif
                      @endforeach

                      <td class="center">{{$brand->brand_description}}</td>
                      <td class="center">
                          @if($brand->publication_status==1)
                            <span class="label label-success">Active</span>

                          @else
                            <span class="label label-danger">UnActive</span>

                          @endif

                      </td>
                      <td class="center">
                          @if($brand->publication_status==1)
                          <a class="btn btn-danger" href="/unactive_brand/{{$brand->brand_id}}">
                              <i class="halflings-icon white thumbs-down"></i>
                          </a>
                          @else
                          <a class="btn btn-success" href="/active_brand/{{$brand->brand_id}}">
                            <i class="halflings-icon white thumbs-up"></i>
                          </a>
                          @endif
                          <a class="btn btn-info" href="/edit_brand/{{$brand->brand_id}}">
                              <i class="halflings-icon white edit"></i>
                          </a>
                          <a class="btn btn-danger" href="/delete_brand/{{$brand->brand_id}}">
                              <i class="halflings-icon white trash"></i>
                          </a>
                      </td>
                  </tr>
                  @endforeach

              </tbody>
          </table>
        </div>
    </div><!--/span-->

</div><!--/row-->

@endsection
