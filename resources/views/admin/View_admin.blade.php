@extends('admin.adminLayout.master')

@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Admin Record</a> </div>
    <h1>View Admin Record</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

        <form method="post" action="{{ url('/searchingAdmin')}}">
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
            <h5>View Admin Record</h5>
          </div>
          <div class="widget-content nopadding">

            @if(Session('msg'))
              {{ Session('msg') }}
            @endif

            <form method="post" action="{{ url('/deleteMultiple') }}">
              {{ csrf_field() }}

              <table class="table table-bordered table-striped with-check">
                <thead>
                  <tr>
                    <th><input type="checkbox" id="select_all" name="title-checkbox" /> <input type="submit" name="submit" value="DeleteAll" /></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Education</th>
                    <th>City</th>
                    <th>Image</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($adminRecord as $ar)
                  <tr>
                    <td><input type="checkbox" name="adminMdelete[]" class="checbox" id="select_all" value="{{ $ar->id }}" /></td>
                    <td>{{ $ar->name }}</td>
                    <td>{{ $ar->email }}</td>
                    <td>{{ $ar->gender }}</td>
                    <td>{{ $ar->education }}</td>
                    <td>{{ $ar->city }}</td>
                    <td><img src="admin/images/{{ $ar->image }}" height="40px" width="40px"></td>
                    <td>{{ $ar->created_at }}</td>
                    <td><a href='{{ url("/AdminDelete/$ar->id")}}'><i class="icon-trash"></i></a> | <a href='{{ url("/AdminEdit/$ar->id")}}'><i class="icon-edit"></i></a></td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="9">
                      {!! $adminRecord->links() !!}
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

@endsection