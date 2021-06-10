@extends('admin.adminLayout.master')

@section('content')

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Add SubCategory Record</a> <a href="#" class="current">Add SubCategory Record</a> </div>
  <h1>Add SubCategory Record</h1>
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
          <form action="{{ url('/add_subcategory_records')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
            {{ csrf_field() }}

            <div class="control-group">
              <label class="control-label">Select Category</label>
              <div class="controls">
                <select name="subcat_name">
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
              <label class="control-label">Enter SubCategory Name</label>
              <div class="controls">
                <input type="text" placeholder="Enter SubCategory Name" name="subcategory_name" class="span11">
              </div>
            </div>
            
            <div class="form-actions">
              <input type="submit" value="Insert SubCategory" name="submit" class="btn btn-success" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div></div>

@endsection