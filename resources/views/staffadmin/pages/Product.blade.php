@extends('staffadmin.layouts.app')
@section('meta')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('admincontent')
          <div class="app-title">
            <div>
              <h1><i class="fa fa-plus-circle"></i> Products</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
            </ul>
          </div>
          @if($cat->count() != 0)
          <div class="row justify-content-center">
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addproductmodal"><i class="fa fa-plus-circle"></i>Add new Product</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button class="btn btn-primary btn-lg"><i class="fa fa-download"></i>Export Inventory</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </div>


          <br>

          <div class="row justify-content-center">

            <div class="col-md-3" align="middle">
                <div class="tile-title-w-btn">
                  <h3 class="title">Select Category</h3>
                </div>
                <div class="bs-component">
                  <div class="list-group" id="highlight1">
                    {{--  Loop through the categories--}}
                    @foreach ($cat as $ct)
                        <a class="list-group-item list-group-item-action" id="_{{ $ct->id }}" onclick="getproduct('_{{ $ct->id }}')" href="#" >{{ $ct->category }}</a>
                    @endforeach
                  </div>

                </div>
            </div>

            <div class="col-9 table-responsive" id="productResult" >
            </div>
          @else
            <h2>No Categories currently in the system</h2>
            <h4>Enter New Categories</h4>
            <a class="btn btn-primary btn-lg" href="{{ route('adminstaff.newcategories') }}"><i class="fa fa-plus-circle"></i>Add New Category</a>&nbsp;
          @endif
          </div>
          {{-- Edit Model Start --}}
          <div class="modal fade" id="productrenamemodal" tabindex="-1" role="dialog" aria-labelledby="productrenamemodalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="productrenamemodalTitle">Edit Name</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  ..
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="submitform()" class="btn btn-info"><b>Submit</b></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- Edit Model End --}}

          {{-- Add Product Modal --}}
          <!-- Modal -->
            <div class="modal fade" id="addproductmodal" tabindex="-1" role="dialog" aria-labelledby="addproductmodaltitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="addproductmodaltitle">Add Product</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
              <form method="POST" action="{{ url('products')}}"  enctype="multipart/form-data">
          			<!-- Name of the product-->
                {{ csrf_field() }}
          			<div class="form-group">
          			  <label for="name">Name:</label>
          			  <input type="text" class="form-control" id="productName" placeholder="Enter product name" name="productName">
          			</div>

          			<!-- Description of the product-->
          			<div class="form-group">
          			  <label for="description">Description:</label>
          			  <textarea class="form-control" rows="5" id="productDescription" name="productDescription" placeholder="Enter product description"></textarea>
          			</div>

          			<!-- Category DropDown -->
          			<div class="form-group">
          				<label for="category">Category:</label>
          				<select class="form-control" id="productCategory" name="productCategory">
          					@foreach($cat as $ct)
          					<option>{{ $ct->category }}</option>
          					@endforeach
          				</select>
          			</div>

          			<!-- Product ID -->
          			<div class="form-group">
          			  <label for="productid">Product ID:</label>
          			  <input type="text" class="form-control" id="productID" placeholder="Enter product id" name="productID">
          			</div>
          			<div class="form-group">
                  <label for="img">Upload Images:</label>
                  <input class="form-control" type="file" name="cover_image" id="file">
          			</div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-default" id="newProductBtn"><b>Add</b></button>
                </div>
              </form>

              </div>
              </div>
              </div>
          </div>
            <!-- Modal ending here -->

@endsection

@section('script')

<script type="text/javascript">

// function to get the product
function getproduct(idval)
{
  // handle the front end highlighting
  var x= document.getElementById("highlight1");
  Array.prototype.forEach.call(x.children, i => {
      i.classList.remove("active");});
      var x= document.getElementById(idval);
      x.classList.add("active");
  // string handling
  var categorgyId = idval.split("_")[1];
  console.log(categorgyId);

  //ajax query to get product

  $.ajax({
  type : 'get',
  url : '{{route('adminstaff.products')}}',
  data:{'categoryId':categorgyId},
  success:function(data){
  console.log(data);
  $('#productResult').empty().html(data);
  }
  });




};

// Script to get the products for a particular category
$('#searchBtn').click(function(){
  // get the value of the input field
  $value=$('#searchbox').val();
  //check the input field then only fire ajax call
  if($value)
  {
    $.ajax({
    type : 'get',
    url : '{{route('localadmin.userlist')}}',
    data:{'search':$value},
    success:function(data){
    $('#userlistdata').empty().html(data);
    }
    });
  }
  else
  {
    // send an alert to input a value
    alert('enter the search parameter');
  }


});














//
// $.ajaxSetup({
//   headers: {
//     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//   }
// });
// // get the input values
// $productName = $('#productName').val();
// $productDescription = $('#productDescription').val();
//
// // submit the values
// $("#newProductBtn").click(function(){
//   console.log('Hello');
//   $.ajax({
//   type : 'post',
//   url : '{{route('products.store')}}',
//   data:{
//     'search': 'welcome'
//   },
//   success:function(data){
//   console.log(data)
//   }
//   });
// });


function hone(idval)
{
  var x= document.getElementById("highlight1");
  Array.prototype.forEach.call(x.children, i => {
      i.classList.remove("active");});
      var x= document.getElementById(idval);
      x.classList.add("active");
};



</script>
@endsection
