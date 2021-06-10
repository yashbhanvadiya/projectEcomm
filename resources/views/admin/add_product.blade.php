@extends('admin.adminLayout.master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<style type="text/css">
  
  .color-flex{
    display: flex;
  }
  .color-flex label {
      margin-right: 30px;
      display: flex;
  }
  .color-flex label input {
      margin-right: 5px;
  }

</style>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Add Product Record</a> <a href="#" class="current">Add Product Record</a> </div>
  <h1>Add Brand Record</h1>
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
          <form action="{{ url('/add_product_records')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
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
                <select name="extra_sub_id" id="extra_sub_id" onchange="return get_extracategory_record()">
                  
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Select ExtraCategory</label>
              <div class="controls">
                <select name="type_extra_id" id="type_extra_id" onchange="return get_type_brand_data()">
                  
                </select>
              </div>
            </div>

            <div id="type_brand">
              <div class="control-group">
                <label class="control-label">Select Type</label>
                <div class="controls">
                  <select name="product_type" id="product_type">
                    
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Select Brand</label>
                <div class="controls">
                  <select name="product_brand" id="product_brand">
                    
                  </select>
                </div>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Enter Product Name</label>
              <div class="controls">
                <input type="text" placeholder="Enter Product Name" name="product_name" class="span11">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Enter Product Price</label>
              <div class="controls">
                <input type="text" placeholder="Enter Product Price" name="product_price" class="span11">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Enter Product Description</label>
              <div class="controls">
                <textarea class="span11" placeholder="Enter Product Description" name="product_description" rows="5"></textarea>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Colors</label>
              <div class="controls color-flex">
                <label>
                  <input type="checkbox" name="product_color[]" value="Red" />
                  Red</label>
                <label>
                  <input type="checkbox" name="product_color[]" value="Blue" />
                  Blue</label>
                <label>
                  <input type="checkbox" name="product_color[]" value="Green" />
                  Green</label>
                <label>
                  <input type="checkbox" name="product_color[]" value="Yellow" />
                  Yellow</label>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Size</label>
              <div class="controls color-flex">
                <label>
                  <input type="checkbox" name="product_size[]" value="2-4" />
                  2 - 4</label>
                <label>
                  <input type="checkbox" name="product_size[]" value="4-6" />
                  4 - 6</label>
                <label>
                  <input type="checkbox" name="product_size[]" value="6-8" />
                  6 - 8</label>
                <label>
                  <input type="checkbox" name="product_size[]" value="8-10" />
                  8 - 10</label>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Upload Image</label>
              <div class="controls">
                <input type="file" name="image" />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Upload Images</label>
              <div class="controls">
                <input type="file" name="mimage[]" multiple="" />
              </div>
            </div>
            
            <div class="form-actions">
              <input type="submit" value="Insert Product" name="submit" class="btn btn-success" />
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


  function get_extracategory_record()
  {
    var cat_id = $('#extra_cat_id').val();
    var sub_id = $('#extra_sub_id').val();
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

  function get_type_brand_data()
  {
    var cat_id = $('#extra_cat_id').val();
    var sub_id = $('#extra_sub_id').val();
    var extra_id = $('#type_extra_id').val();
    
    get_brand_type_record_data(cat_id,sub_id,extra_id);
    $.ajax({
      url : "/get_type_brand_record",
      type : "POST",
      data : {
        'cat_id' : cat_id,
        'sub_id' : sub_id,
        'extra_id' : extra_id,
        '_token' : "{{ csrf_token() }}",
      },
      success:function(res)
      {
        $('#product_type').html(res);
      }

    });
  }

  function get_brand_type_record_data(cat_id='',sub_id='',extra_id='')
  {
    $.ajax({
      url : "/get_brand_type_record",
      type: "POST",
      data : {
        'cat_id' : cat_id,
        'sub_id' : sub_id,
        'extra_id' : extra_id,
        '_token' : "{{ csrf_token() }}",
      },
      success:function(res)
      {
        $('#product_brand').html(res);
      }
    });
  }

</script>

@endsection