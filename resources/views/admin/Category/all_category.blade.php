@extends('admin_layout')
@section('admin_content')
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Home</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">Categories</a></li>
</ul>

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
                      <th>Category Id</th>
                      <th>Category Name</th>
                      <th>Category Description</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($categories as $category)

                  <tr>
                      <td>{{$category->category_id}}</td>
                      <td>{{$category->category_name}}</td>

                      <td class="center">{{$category->category_description}}</td>
                      <td class="center">
                          @if($category->publication_status==1)
                            <span class="label label-success">Active</span>

                          @else
                            <span class="label label-danger">UnActive</span>

                          @endif

                      </td>
                      <td class="center">
                          @if($category->publication_status==1)
                          <a class="btn btn-danger" href="/unactive_cat/{{$category->category_id}}">
                              <i class="halflings-icon white thumbs-down"></i>
                          </a>
                          @else
                          <a class="btn btn-success" href="/active_cat/{{$category->category_id}}">
                            <i class="halflings-icon white thumbs-up"></i>
                          </a>
                          @endif
                          <a class="btn btn-info" href="/edit_cat/{{$category->category_id}}">
                              <i class="halflings-icon white edit"></i>
                          </a>
                          <a class="btn btn-danger" onclick="alert('are you sure? you want to delete.')" href="/delete-cat/{{$category->category_id}}">
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
