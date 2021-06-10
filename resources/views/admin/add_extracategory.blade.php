@extends('admin.adminLayout.master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Add ExtraCategory Record</a> <a href="#" class="current">Add ExtraCategory Record</a> </div>
  <h1>Add ExtraCategory Record</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">

      @if(Session('msg'))
          <div class="alert alert-success">
            {{ Session('msg') }}
          </div>
      @endif

      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Form Elements</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="{{ url('/add_extracategory_records')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
            {{ csrf_field() }}

            <div class="control-group">
              <label class="control-label">Select Category</label>
              <div class="controls">
                <select name="extra_cat_id" id="extra_cat_id" onchange="return get_subcategory_record()">
                  <option>-- Select Category --</option>
                  @foreach($cat as $c)
                    <option value="{{ $c->category_name }}">
                      {{ $c->category_name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Select SubCategory</label>
              <div class="controls">
                <select name="extra_sub_id" id="extra_sub_id">
                  
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Enter ExtraCategory Name</label>
              <div class="controls">
                <input type="text" placeholder="Enter ExtraCategory Name" name="extracategory_name" class="span11">
              </div>
            </div>
            
            <div class="form-actions">
              <input type="submit" value="Insert ExtraCategory" name="submit" class="btn btn-success" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div></div>

<script type="text/javascript">

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


  function get_subcategory_record()
  {
    var cat_id = $('#extra_cat_id').val();
    $.ajax({
      url : "/get_subcategory_record",
      type : "POST",
      data : {
        'cat_id' : cat_id,
         "_token": "{{ csrf_token() }}",
      },
      success:function(res)
      {
        $('#extra_sub_id').html(res);
      }

    });
  }

</script>

@endsection