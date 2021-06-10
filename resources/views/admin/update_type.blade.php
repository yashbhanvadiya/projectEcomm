@extends('admin.adminLayout.master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Update Type Record</a> <a href="#" class="current">Update Type Record</a> </div>
  <h1>Update Type Record</h1>
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
          <form action="{{ url('/update_type_records')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
            {{ csrf_field() }}

            <input type="hidden" name="edit_type_id" value="{{ $TypeR->type_id }}">

            <div class="control-group">
              <label class="control-label">Select Category</label>
              <div class="controls">
                <select name="type_cat_id" id="type_cat_id" onchange="return get_subcategory_record()">
                  <option>-- Select Category --</option>
                  @foreach($catR as $c)
                    <option value="{{ $c->category_name }}" @if($TypeR->type_cat_id == $c->category_name){{
                      'selected' }} @endif>
                      {{ $c->category_name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Select SubCategory</label>
              <div class="controls">
                <select name="type_sub_id" id="type_sub_id" onchange="return get_extracategory_record()">
                  <option>-- Select Subcategory --</option>
                  @foreach($subR as $cr)
                    <option value="{{ $cr->subcategory_name }}" @if($TypeR->type_sub_id == $cr->subcategory_name){{
                      'selected' }} @endif>
                      {{ $cr->subcategory_name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Select ExtraCategory</label>
              <div class="controls">
                <select name="type_extra_id" id="type_extra_id">
                  @foreach($extraR as $sr)
                    <option value="{{ $sr->extracategory_name }}" @if($TypeR->type_extra_id == $sr->extracategory_name){{ 'selected' }} @endif>
                      {{ $sr->extracategory_name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Enter Type Name</label>
              <div class="controls">
                <input type="text" placeholder="Enter Type Name" name="type_name" class="span11" value="{{ $TypeR->type_name }}">
              </div>
            </div>
            
            <div class="form-actions">
              <input type="submit" value="Update Type" name="submit" class="btn btn-success" />
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
    var cat_id = $('#type_cat_id').val();
    $.ajax({
      url : "/get_subcategory_record",
      type : "POST",
      data : {
        'cat_id' : cat_id,
         "_token": "{{ csrf_token() }}",
      },
      success:function(res)
      {
        $('#type_sub_id').html(res);
      }

    });
  }


  function get_extracategory_record()
  {
    var cat_id = $('#type_cat_id').val();
    var sub_id = $('#type_sub_id').val();
    var extra_id = $('#type_extra_id').val();
    $.ajax({
      url : "/get_extracategory_record_type",
      type : "POST",
      data : {
        'cat_id' : cat_id,
        'sub_id' : sub_id,
        "_token": "{{ csrf_token() }}",
      },
      success:function(res)
      {
        $('#type_extra_id').html(res);
      }

    });
  }


</script>

@endsection