@extends('layouts.app')

@section('style')
<style>

  /*.btn-search {
      background-color: #666;
      color: #fff;
      border-radius:0;
      border-color:#666;
  }

  .input-search {
      border-radius:0;
      background-color: #eee;
      box-shadow: none;
      border: none;
      border-right: 1px solid #eee;
  }

  .input-search:focus {
      box-shadow: none;
  }
  td
  {
      valign:"middle";
  }*/


  </style>

@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" >
                <div class="panel-heading" >ADMIN Dashboard</div>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-1">
                        <div class="input-group" >
                            <input class="form-control input-search" type="text" id="searchbox">
                            <span class="input-group-btn">
                              <button class="btn btn-search" type="button" id="searchBtn">Search</button>
                            </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                 </div><!-- /.row -->
                <br>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">User Name</th>
                            <th scope="col">Email ID</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody id="userlistdata">


                        </tbody>
                    </table>
          </div>
      </div>
  </div>
</div>
@endsection

@section('script')

<script type="text/javascript">

  // $('#searchBtn').click(function(){
  //   alert('It works');
  //   $.get("{{route('localadmin.userlist')}}",{search: $('#searchBtn').val(),},function(data){
  //       console.log(data);
  //   });
  // });


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


{{-- <script type="text/javascript">
var catRequest;  // The variable that makes Ajax possible!


                       try {
                           // Opera 8.0+, Firefox, Safari
                           catRequest = new XMLHttpRequest();
                       } catch (e) {
                           // Internet Explorer Browsers
                           try {
                               catRequest = new ActiveXObject("Msxml2.XMLHTTP");
                           } catch (e) {
                               try {
                                   catRequest = new ActiveXObject("Microsoft.XMLHTTP");

                               }
                               finally {
                               }
                           }
                       }
                       finally {
                       }


                       catRequest.onreadystatechange = function () {
                           if (catRequest.readyState == 4) {
                               var ajaxDisplay = document.getElementById('CatList');
                               ajaxDisplay.innerHTML =  catRequest.responseText;



                           }
                       }

                       //for Categories


                       function step1(){
                           if($('#fromDate').val() && $('#toDate').val() ){ //validation that the user has actually selected the dates.
                               var fromDate = $('#fromDate').val();
                               var toDate = $('#toDate').val();
                               $('.stepTwo').show();

                               <!--For button cat-->

                               catRequest.open("GET", "/getCat", true);
                               catRequest.send(null);
                           }
                       }

$('#search').click(function(){
  var query = document.getElementById('searchbox').value;
  console.log("userlist="+query);
  var xx={{csrf_token()}};
  query="userlist="+query+"&_token="+xx.toString();
  // $.ajax({
  //         type: 'POST',
  //         url: "{{ route('localadmin.userlist') }}",
  //         data: {
  //             '_token': '{{csrf_token()}}',
  //             'search': query
  //         },
  //         success: function(e) {
  //
  //             console.log(e);
  //         },
  //     });
      var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("userlist").innerHTML = this.responseText;
          }
        };
        xhttp.open("POST", "getuserlist", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);

});


function makeadmin(i)
{
    $.ajax({
        type: "POST",

        url: 'makeasadmin',
        data: {'id': i,_token: '{{csrf_token()}}'},
        success: function (msg) {
            if (msg) {
                console.log(msg);
                searchuser();
            }
            else {
                alert("Request not proceed");
            }
        }
    });
}

function removeadmin(i)
{
    $.ajax({
        type: "POST",

        url: 'localadmin/removeadmin',
        data: {'id': i,_token: '{{csrf_token()}}'},
        success: function (msg) {
            if (msg) {
                searchuser();
            }
            else {
                alert("Request not proceed");
            }
        }
    });
}
 --}}
</script>
@endsection
