@extends('staffadmin.layouts.app')

@section('admincontent')
  <div class="app-title">
    <div>
      <h1><i class="fa fa-pencil-square-o"></i> Categories</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
    </ul>
  </div>
  @if($cat->count() == 0)
    <h1>No Categories currently entered in the system</h1>
  @else
    <div class="row justify-content-center">
      <div class="col-6 table-responsive" >
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Sr.No</th>
              <th>Category Name</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($cat as $ct)
              <tr>
                <td>{{$ct->id}}</td>
                <td>{{$ct->category}}</td>
                <td><button class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>Rename</button></td>
                <td>
                  <button class="btn btn-danger" data-toggle="modal" data-target="#myDeleteModal" id="deleteButton" value="{{$ct->id}}"><i class="fa fa-trash-o"></i>Delete</button>

                </td>

              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @endif

  <div class="row justify-content-center">
    <form  action="{{ route('adminstaff.newcategories') }}" method="POST">
      {{ csrf_field() }}
      <input type="text" placeholder="Enter New Category" name="category">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-plus-circle"></i>Add new Category</button>
    </form>
  </div>
<!-- Delete Modal -->
<div class="modal fade" id="myDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body">
        Are you sure you want to delete ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <form id="deleteForm" method="POST" action="">
          <input type="hidden" name="_method" value="DELETE">
          {{ csrf_field() }}
          <button class="btn btn-danger" type="submit" value="Delete">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@script
<script type="text/javascript">
  window.onload = function(){
    $('#deleteButton').click(function(){
        // get the value id of the button
        var catId = $(this).val();
        var formAction = 'http://localhost:8000/admin/categories/delete/' + catId;
        $('#deleteForm').attr('action',formAction);
    });
  }


</script>
@endscript
