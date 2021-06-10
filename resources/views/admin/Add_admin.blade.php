@extends('admin.adminLayout.master')

@section('content')

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Add Admin Record</a> <a href="#" class="current">Add Admin Record</a> </div>
  <h1>Add Admin Record</h1>
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
          <form action="{{ url('/add_admin_records')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
            {{ csrf_field() }}

            <div class="control-group">
              <label class="control-label">Enter First Name</label>
              <div class="controls">
                <input type="text" placeholder="Enter First Name" name="fname" class="span11">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Enter Last Name</label>
              <div class="controls">
                <input type="text" placeholder="Enter Last Name" name="lname" class="span11">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Enter Email</label>
              <div class="controls">
                <input type="text" placeholder="Enter Email" name="email" class="span11">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Enter Password</label>
              <div class="controls">
                <input type="password" placeholder="Enter Password" name="password" class="span11">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Gender</label>
              <div class="controls">
                <label>
                  <input type="radio" name="gender" value="male" />
                  Male</label>
                <label>
                  <input type="radio" name="gender" value="female" />
                  Female</label>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Education</label>
              <div class="controls">
                <label>
                  <input type="checkbox" name="education[]" value="10th" />
                  10th</label>
                <label>
                  <input type="checkbox" name="education[]" value="12th" />
                  12th</label>
                <label>
                  <input type="checkbox" name="education[]" value="graduation" />
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
                    <option value="<?php echo $city[$i]; ?>"><?php echo $city[$i]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">File Image</label>
              <div class="controls">
                <input type="file" name="image" />
              </div>
            </div>
            
            <div class="form-actions">
              <input type="submit" value="Insert Admin" name="submit" class="btn btn-success" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div></div>

@endsection