@if($products->count() != 0)
<table class="table table-striped">
  <thead>
    <tr>
      <th>Product Id</th>
      <th>Name</th>
      <th>Description</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($products as $prod)
    <tr>
      <td style="padding:5px">
        <div class="media">
              <a href="#" class="pull-left">
                {{-- <img src="/storage/cover_images/{{$productImage->cover_image}}" class="media-photo" style="width:40px;height:40px"> --}}
                {{ $prod->ProductImages->where('product_id', $prod->productID)->first()->cover_image }}
              </a>
        </div>
      </td>
      <td>{{ $prod->name }}</td>
      <td>{{ str_limit($prod->description,10) }}...</td>
      <td>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productrenamemodal"><i class="fa fa-pencil-square-o"></i>
          Rename
        </button>
        <button class="btn btn-danger"><i class="fa fa-trash-o"></i>Delete</button>


      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
  <h2> No Products for this particular category</h2>
@endif
