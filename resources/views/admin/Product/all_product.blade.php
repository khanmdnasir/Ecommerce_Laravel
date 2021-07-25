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
                      <th>Product Id</th>
                      <th>Category Name</th>
                      <th>SubCategory Name</th>
                      <th>Brand Name</th>
                      <th>Product Name</th>
                      {{-- <th>Short Description</th> --}}
                      <th>Product Price</th>
                      <th>Product Size</th>
                      <th>Product Color</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($products as $product)

                  <tr>
                      <td>{{$product->product_id}}</td>
                      <td>
                        @foreach  ($categories as $cat)
                        @if($product->category_id==$cat->category_id)
                        {{$cat->category_name}}
                        @endif
                        @endforeach
                      </td>
                      <td>
                        @foreach  ($sub_categories as $sub_cat)
                        @if($product->sub_cat_id==$sub_cat->sub_cat_id)
                        {{$sub_cat->sub_cat_name}}
                        @endif
                        @endforeach
                      </td>
                      <td>
                        @foreach  ($brands as $brand)
                        @if($product->brand_id==$brand->brand_id)
                        {{$brand->brand_name}}
                        @endif
                        @endforeach
                      </td>

                      <td >{{$product->product_name}}</td>
                      {{-- <td >{{$product->product_short_description}}</td> --}}
                      <td >{{$product->product_price}}</td>
                      <td >{{$product->product_size}}</td>
                      <td >{{$product->product_color}}</td>
                      <td >
                          @if($product->publication_status==1)
                            <span class="label label-success">Active</span>

                          @else
                            <span class="label label-danger">UnActive</span>

                          @endif

                      </td>
                      <td class="center">
                          @if($product->publication_status==1)
                          <a class="btn btn-danger" href="/unactive_product/{{$product->product_id}}">
                              <i class="halflings-icon white thumbs-down"></i>
                          </a>
                          @else
                          <a class="btn btn-success" href="/active_product/{{$product->product_id}}">
                            <i class="halflings-icon white thumbs-up"></i>
                          </a>
                          @endif
                          <a class="btn btn-info" href="/edit_product/{{$product->product_id}}">
                              <i class="halflings-icon white edit"></i>
                          </a>
                          <a class="btn btn-danger" href="/delete_product/{{$product->product_id}}">
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
