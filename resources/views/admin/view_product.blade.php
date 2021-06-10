@extends('admin.adminLayout.master')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Type Record</a> </div>
    <h1>View Brand Record</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

        @if(Session('msg'))
        <div class="alert alert-success">
          {{ Session('msg') }}
        </div>
        @endif

        @if(Session('msg_da'))
        <div class="alert alert-danger">
          {{ Session('msg_da') }}
        </div>
        @endif

        <form method="post" action="{{ url('/searchingbrand')}}">
          {{ csrf_field() }}
          <div class="control-group row">
            <div class="col-md-6 d-flex">
              <div class="controls col-md-6">
                <input type="text" name="search" class="span12" />
              </div>
              <div class="controls col-md-3">
                <input type="submit" name="submit" value="submit" />
              </div>
            </div>
            <div class="col-md-6">

            </div>
          </div>
        </form>

        <div class="widget-box">
          <div class="widget-title"> <span class="icon">
            
            </span>
            <h5>View Brand Record</h5>
          </div>
          <div class="widget-content nopadding">

            <form method="post" action="{{ url('/deleteMultiple') }}">
              {{ csrf_field() }}

              <table class="table table-bordered table-striped with-check">
                <thead>
                  <tr>
                    <th><input type="checkbox" id="select_all" name="title-checkbox" /> <input type="submit" name="submit" value="DeleteAll" /></th>
                    <th>Category Name</th>
                    <th>Subcategory Name</th>
                    <th>Extracategory Name</th>
                    <th>Product Type</th>
                    <th>Product Brand</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Description</th>
                    <th>Product Color</th>
                    <th>Product Size</th>
                    <th>Product Image</th>
                    <th>Product Mimge</th>
                    <th>Product Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>  
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($productAll as $ar)
                  <tr>
                    <td><input type="checkbox" name="adminMdelete[]" class="checbox" id="select_all" value="{{ $ar->brand_id }}" /></td>
                    <td>{{ $ar->product_category }}</td>
                    <td>{{ $ar->product_subcategory }}</td>
                    <td>{{ $ar->product_extracategory }}</td>
                    <td>{{ $ar->product_type }}</td>
                    <td>{{ $ar->product_brand }}</td>
                    <td>{{ $ar->product_name }}</td>
                    <td>{{ $ar->product_price }}</td>
                    <td>{{ $ar->product_description }}</td>
                    <td>{{ $ar->product_color }}</td>
                    <td>{{ $ar->product_size }}</td>
                    <td>{{ $ar->product_image }}</td>
                    <td>{{ $ar->product_mimage }}</td>
                    <td>
                        @if($ar->brand_status == 0) 
                            <a href='javascript:active_brand("{{ $ar->product_id }}")' class="btn btn-danger">Deactive</a>

                        @else    
                            <a href='javascript:deactive_brand("{{ $ar->product_id }}")' class="btn btn-success">Active</a>

                        @endif
                    </td>
                    <td>{{ $ar->created_at }}</td>
                    <td>{{ $ar->updated_at }}</td>
                    <td><a href='{{ url("/BrandDelete/$ar->product_id")}}'><i class="icon-trash"></i></a> | <a href='{{ url("/BrandEdit/$ar->product_id")}}'><i class="icon-edit"></i></a></td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="9">
                      {!! $productAll->links() !!}
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('select_all').onclick = function() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var checkbox of checkboxes) {
      checkbox.checked = this.checked;
    }
  }
</script>

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<script>
  
  function active_brand(id)
  {
    var con = confirm("Are you sure to change status ?");
    if(con)
    {
      $.ajax({
        type : "get",
        url : "Active_brand/"+id,
        data : {
          "_token": $('#token').val() 
        },
        success:function(response)
        {
          if(response == 1)
          {
            window.location = "/view_brand";
          }
        }
      });
    }
    else
    {
      alert("There no changes !!");
      return false;
    }
  }

  function deactive_brand(id)
  {
    var con = confirm("Are you sure to change status ?");
    if(con)
    {
      $.ajax({
        type : "get",
        url : "Deactive_brand/"+id,
        data : {
          "_token": $('#token').val() 
        },
        success:function(response)
        {
          if(response == 1)
          {
            window.location = "/view_brand";
          }
        }
      });
    }
    else
    {
      alert("There no changes !!");
      return false;
    }
  }

</script>

@endsection