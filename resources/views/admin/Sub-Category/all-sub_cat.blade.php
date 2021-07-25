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
                      <th>SubCategory Id</th>
                      <th>SubCategory Name</th>
                      <th>Category Name</th>
                      <th>SubCategory Description</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($sub_categories as $sub_category)

                  <tr>
                      <td>{{$sub_category->sub_cat_id}}</td>
                      <td>{{$sub_category->sub_cat_name}}</td>
                      @foreach ($categories as $category)
                        @if($sub_category->category_id==$category->category_id)
                        <td>{{$category->category_name}}</td>
                        @endif
                      @endforeach

                      <td class="center">{{$sub_category->sub_cat_description}}</td>
                      <td class="center">
                          @if($sub_category->publication_status==1)
                            <span class="label label-success">Active</span>

                          @else
                            <span class="label label-danger">UnActive</span>

                          @endif

                      </td>
                      <td class="center">
                          @if($sub_category->publication_status==1)
                          <a class="btn btn-danger" href="/unactive-sub_cat/{{$sub_category->sub_cat_id}}">
                              <i class="halflings-icon white thumbs-down"></i>
                          </a>
                          @else
                          <a class="btn btn-success" href="/active-sub_cat/{{$sub_category->sub_cat_id}}">
                            <i class="halflings-icon white thumbs-up"></i>
                          </a>
                          @endif
                          <a class="btn btn-info" href="/edit-sub_cat/{{$sub_category->sub_cat_id}}">
                              <i class="halflings-icon white edit"></i>
                          </a>
                          <a class="btn btn-danger" href="/delete-sub_cat/{{$sub_category->sub_cat_id}}">
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
