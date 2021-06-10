@extends('admin.adminLayout.master')

@section('content')

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Edit Admin Record</a> <a href="#" class="current">Edit Admin Record</a> </div>
  <h1>Edit Admin Record</h1>
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
          <form action="{{ url('/edit_admin_records')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
            {{ csrf_field() }}

            <input type="hidden" name="admin_id" value="{{ $adminRec->id }}" />

            <?php $name = explode(' ',$adminRec->name); ?>
            <div class="control-group">
              <label class="control-label">Enter First Name</label>
              <div class="controls">
                <input type="text" placeholder="Enter First Name" name="fname" class="span11" value="@if(isset($name[0])){{ $name[0] }}@endif">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Enter Last Name</label>
              <div class="controls">
                <input type="text" placeholder="Enter Last Name" name="lname" class="span11" value="@if(isset($name[1])){{ $name[1]}}@endif">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Enter Email</label>
              <div class="controls">
                <input type="text" placeholder="Enter Email" name="email" class="span11" value="@if(isset($adminRec->email)){{ $adminRec->email }}@endif ">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Gender</label>
              <div class="controls">
                <label>
                  <input type="radio" name="gender" value="male" @if(isset($adminRec->gender)) @if($adminRec->gender == 'male'){{ 'checked'}} @endif @endif/>
                  Male</label>
                <label>
                  <input type="radio" name="gender" value="female" @if(isset($adminRec->gender)) @if($adminRec->gender == 'female') {{ 'checked' }} @endif @endif/>
                  Female</label>
              </div>
            </div>

            <?php $edu = explode('-',$adminRec->education); ?>
            <div class="control-group">
              <label class="control-label">Education</label>
              <div class="controls">
                <label>
                  <input type="checkbox" name="education[]" value="10th" @if(isset($edu)) @if(in_array('10th',$edu)) {{ 'checked' }} @endif @endif />
                  10th</label>
                <label>
                  <input type="checkbox" name="education[]" value="12th" @if(isset($edu)) @if(in_array('12th',$edu)) {{ 'checked' }} @endif @endif />
                  12th</label>
                <label>
                  <input type="checkbox" name="education[]" value="graduation" @if(isset($edu)) @if(in_array('graduation',$edu)) {{ 'checked' }} @endif @endif />
                  Graduation</label>
              </div>
            </div>

            <?php $city = array('surat','ahamdabad','rajkot','vadodara'); ?>
            <div class="control-group">
              <label class="control-label">Select City</label>
              <div class="controls">
                <select name="city">
                  <option>-- Select City --</option>
                  <?php for($i=0;$i<sizeof($city);$i++) { ?>
                    <option value="<?php echo $city[$i]; ?>" @if(isset($adminRec->city)) @if($adminRec->city == $city[$i]) {{ 'selected' }} @endif @endif><?php echo $city[$i]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">File Image</label>
              <div class="controls">
                <input type="file" name="image" />
                <img src='{{ url("/admin/images/$adminRec->image") }}' width="40px" height="40px" />
              </div>
            </div>
            
            <div class="form-actions">
              <input type="submit" value="Update Record" name="submit" class="btn btn-success" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div></div>

@endsection