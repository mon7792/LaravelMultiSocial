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
<form method="POST" action=""  enctype="multipart/form-data" id="editProductForm">
{{ csrf_field() }}
<input name="_method" type="hidden" value="PUT">
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
<select class="form-control" id="product_category" name="productCategory">
  @foreach($cat as $ct)
  <option>{{ $ct->category }}</option>
  @endforeach
</select>
</div>

<!-- Product ID -->
<div class="form-group">
<label for="productid">Product ID:</label>
<p id="productid"></p>
</div>
<div class="form-group">
<label for="img">Upload Images:</label>
<input class="form-control" type="file" name="cover_image" id="file">
</div>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-default" id="newProductBtn"><b>Update</b></button>
</form>

</div>
    </div>
  </div>
</div>
{{-- Edit Model End --}}
