<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>Matrix Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/bootstrap-responsive.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/matrix-login.css') }}" />
        <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="loginbox">    
        @if(Session('msg'))
            <div class="alert alert-danger">
                {{ Session('msg') }}
            </div>
        @endif       
            <form id="loginform" class="form-vertical" method="post" action="{{ url('/confirmChangepassword')}}">
                {{ csrf_field() }}
				<div class="control-group normal_text"> <h3>Create New Password</h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="password" placeholder="New Password" name="npass" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="Confirm Password" name="cpass" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-right">
                    <input type="submit" name="submit" value="Change Password" class="btn btn-success" /></span>
                </div>
            </form>

        </div>
        
        <script src="{{ asset('js/jquery.min.js') }}"></script>  
        <script src="{{ asset('js/matrix.login.js') }}"></script> 
    </body>

</html>
