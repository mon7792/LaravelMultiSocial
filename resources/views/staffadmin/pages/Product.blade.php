@extends('staffadmin.layouts.app')

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

                    <a class="list-group-item list-group-item-action active" id="Instruments" onclick="hone('Instruments')" href="#" >Instruments</a>
                    <a class="list-group-item list-group-item-action" id="Music" onclick="hone('Music')" href="#">Music</a>
                    <a class="list-group-item list-group-item-action" id="Utensils" onclick="hone('Utensils')" href="#">Utensils</a>
                    <a class="list-group-item list-group-item-action" id="Electronics" onclick="hone('Electronics')" href="#">Electronics</a>
                    <a class="list-group-item list-group-item-action" id="Costumes" onclick="hone('Costumes')" href="#">Costumes</a>
                  </div>

                </div>
            </div>

            <div class="col-9 table-responsive " >
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Product Id</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>

                    <td style="padding:5px">
                      <div class="media">
                            <a href="#" class="pull-left">
                              <img src="img/IMG.jpg" class="media-photo" style="width:40px;height:40px">
                            </a>
                      </div>
                    </td>
                    <td>The Hunger Games</td>
                    <td>HIIII</td>
                    <td>

                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productrenamemodal"><i class="fa fa-pencil-square-o"></i>
                        Rename
                      </button>
                      <button class="btn btn-danger"><i class="fa fa-trash-o"></i>Delete</button>


                    </td>
                  </tr>
                  <tr>

                    <td>2</td>
                    <td>The Lord of the Rings</td>
                    <td>TTTIIII</td>
                    <td><button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>Rename</button>
                    <button class="btn btn-danger"><i class="fa fa-trash-o"></i>Delete</button></td>
                  </tr>
                  <tr>

                    <td>3</td>
                    <td>Star Wars</td>
                    <td>IIII</td>
                    <td><button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>Rename</button>
                    <button class="btn btn-danger"><i class="fa fa-trash-o"></i>Delete</button></td>
                  </tr>
                </tbody>
              </table>
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
              <form method="POST"  enctype="multipart/form-data">
          			<!-- Name of the product-->
                {{-- action="{{ url('products')}}" --}}
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
          					{{-- @foreach($category as $cat)
          					<option>{{ $cat->category }}</option>
          					@endforeach --}}
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
          		</form>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-default"><b>Submit</b></button>
              </div>
              </div>
              </div>
              </div>
          </div>
            <!-- Modal ending here -->

@endsection
@section('script')

<script type="text/javascript">
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
